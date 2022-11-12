<?php

namespace common\behaviors;

use Closure;
use common\components\Cdn;
use runwidget\formbuilder\models\FormExtraFieldActiveRecord;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\mongodb\ActiveRecord;
use yii\web\UploadedFile;

/**
 * UploadBehavior automatically uploads file and fills the specified attribute
 * with a value of the name of the uploaded file.
 *
 * To use UploadBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use common\behaviors\UploadBehavior;
 *
 * function behaviors()
 * {
 *     return [
 *         [
 *             'class' => UploadBehavior::className(),
 *             'attribute' => 'file',
 *             'scenarios' => ['insert', 'update'],
 *             'path' => '@webroot/upload/{id}',
 *             'url' => '@web/upload/{id}',
 *         ],
 *     ];
 * }
 * ```
 */
class UploadBehavior extends Behavior
{
    /**
     * @event Event an event that is triggered after a file is uploaded.
     */
    const EVENT_AFTER_UPLOAD = 'afterUpload';

    /**
     * @var string|\closure the attribute which holds the attachment.
     * The signature of the anonymous function should be as follows,
     *
     * ```php
     * function($model) {
     *     // compute attribute
     *     return $attribute;
     * }
     * ```
     */
    public $attribute;

    /**
     * @var string|\closure old value of attribute.
     * The signature of the anonymous function should be as follows,
     *
     * ```php
     * function($model) {
     *     // compute oldAttribute
     *     return $oldAttribute;
     * }
     * ```
     */
    public $oldAttribute;

    /**
     * @var array extra attributes.
     */
    public $extraAttributes = [];
    /**
     * @var array the scenarios in which the behavior will be triggered
     */
    public $scenarios = [];
    /**
     * @var string the path or path alias to the directory in which to save files.
     */
    public $path;
    /**
     * @var string the base path or path alias to the directory in which to save files.
     */
    public $basePath;
    /**
     * @var string the base URL or path alias for this file
     */
    public $url;
    /**
     * @var bool Getting file instance by name
     */
    public $instanceByName = false;
    /**
     * @var array name of instance files
     */
    public $instanceNames = [];
    /**
     * @var boolean|callable generate a new unique name for the file
     * set true or anonymous function takes the old filename and returns a new name.
     * @see self::generateFileName()
     */
    public $generateNewName = true;
    /**
     * @var boolean If `true` current attribute file will be deleted
     */
    public $unlinkOnSave = true;
    /**
     * @var boolean If `true` current attribute file will be deleted after model deletion.
     */
    public $unlinkOnDelete = true;
    /**
     * @var boolean $deleteTempFile whether to delete the temporary file after saving.
     */
    public $deleteTempFile = true;
    /**
     * @var boolean $deleteBasePathOnDelete whether to delete the basePath directory after delete owner model.
     */
    public $deleteBasePathOnDelete = false;
    /**
     * @var boolean $transferToCDN whether to transfer file to CDN.
     */
    public $transferToCDN = false;
    /**
     * @var string $cdnPath the path or path alias to the directory in which to transfer files.
     */
    public $cdnPath;
    /**
     * @var boolean If `true` current attribute file will be deleted after transfer to CDN.
     */
    public $unlinkOnTransferToCDN = true;
    /**
     * @var boolean If `true` current attribute file will be deleted from CDN after delete.
     */
    public $deleteFromCDN;
    /**
     * @var boolean If `true` current attribute file will be deleted after transfer to CDN.
     */
    public $convertImageToWebp = true;
    /**
     * @var UploadedFile the uploaded file instance.
     */
    private $_file;

    /**
     * @var string
     */
    private $isAttributeChanged = false;

    /**
     * @var bool if `true` videos url after upload sends to cdn.arvancloud.com
     */
    public $uploadToArvan;

    public $video_title;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->attribute === null) {
            throw new InvalidConfigException('The "attribute" property must be set.');
        }
        if ($this->path === null) {
            throw new InvalidConfigException('The "path" property must be set.');
        }
        if ($this->deleteBasePathOnDelete && $this->basePath === null) {
            throw new InvalidConfigException('The "basePath" property must be set.');
        }
        if ($this->url === null) {
            throw new InvalidConfigException('The "url" property must be set.');
        }
        if ($this->transferToCDN && $this->cdnPath === null) {
            throw new InvalidConfigException('The "cdnPath" property must be set.');
        }

        $this->deleteFromCDN = $this->deleteFromCDN ?? $this->transferToCDN;
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    /**
     * This method is invoked before validation starts.
     */
    public function beforeValidate()
    {
        if ($this->attribute instanceof \Closure) {
            $this->attribute = call_user_func($this->attribute, $this->owner);
        }
        if ($this->attribute === null)
            return false;

        /** @var FormExtraFieldActiveRecord $model */
        $model = $this->owner;
        $file = null;

        if ($model->hasAttribute($this->attribute)) {
            $file = $model->getAttribute($this->attribute);
        } elseif (in_array($this->attribute, $this->extraAttributes)) {
            $file = $model->{$this->attribute};
        }

        if (in_array($model->scenario, $this->scenarios)) {
            if ($file instanceof UploadedFile) {
                $this->_file = $file;
            } else {
                if ($this->instanceByName === true) {
                    $this->_file = UploadedFile::getInstanceByName($this->owner->instanceNames[$this->attribute] ?? $this->attribute);
                } else {
                    $this->_file = UploadedFile::getInstance($model, $this->attribute);
                }
            }
            if ($this->_file instanceof UploadedFile) {
                $this->_file->name = $this->getFileName($this->_file);
                if ($model->hasAttribute($this->attribute)) {
                    $model->setAttribute($this->attribute, $this->_file);
                } elseif (in_array($this->attribute, $this->extraAttributes)) {
                    $model->{$this->attribute} = $this->_file;
                }
            } else {
                $model->{$this->attribute} = null;
            }
        }
    }

    /**
     * This method is called at the beginning of inserting or updating a record.
     * @throws \Exception
     */
    public function beforeSave()
    {
        if ($this->attribute === null)
            return false;

        /** @var FormExtraFieldActiveRecord $model */
        $model = $this->owner;

        if ($this->oldAttribute instanceof \Closure) {
            $this->oldAttribute = call_user_func($this->oldAttribute, $model);
        }

        if ($model->hasAttribute($this->attribute)) {
            $this->isAttributeChanged = $model->isAttributeChanged($this->attribute);
        } elseif (in_array($this->attribute, $this->extraAttributes)) {
            $this->isAttributeChanged = ($this->oldAttribute !== $model->{$this->attribute});
        }

        if (in_array($model->scenario, $this->scenarios)) {
            if ($this->_file instanceof UploadedFile) {
                if (!$model->getIsNewRecord() && $this->isAttributeChanged) {
                    if ($this->unlinkOnSave === true) {
                        $this->delete($this->attribute, true, $this->deleteFromCDN);
                    }
                }
                if ($model->hasAttribute($this->attribute)) {
                    $model->setAttribute($this->attribute, $this->_file->name);
                } elseif (in_array($this->attribute, $this->extraAttributes)) {
                    $model->{$this->attribute} = $this->_file->name;
                }

            } else {
                // Protect attribute
                if (!$model->getIsNewRecord()) {
                    unset($model->{$this->attribute});
                }
            }
        } else {
            if (!$model->getIsNewRecord() && $this->isAttributeChanged) {
                if ($this->unlinkOnSave === true) {
                    $this->delete($this->attribute, true, $this->deleteFromCDN);
                }
            }
        }
    }

    /**
     * This method is called at the end of inserting or updating a record.
     * @throws \yii\base\InvalidParamException
     */
    public function afterSave()
    {
        if ($this->attribute === null)
            return false;

        if ($this->_file instanceof UploadedFile) {
            $path = $this->getUploadPath($this->attribute);
            if (is_string($path) && FileHelper::createDirectory(dirname($path))) {
                $this->save($this->_file, $path);
                $this->afterUpload();
            } else {
                throw new InvalidParamException("Directory specified in 'path' attribute doesn't exist or cannot be created.");
            }
        }
    }

    /**
     * This method is invoked before deleting a record.
     */
    public function beforeDelete()
    {
        /** @var FormExtraFieldActiveRecord $model */
        $model = $this->owner;

        if ($this->attribute instanceof \Closure) {
            $this->attribute = call_user_func($this->attribute, $model);
        }

        if ($this->oldAttribute instanceof \Closure) {
            $this->oldAttribute = call_user_func($this->oldAttribute, $model);
        }
    }

    /**
     * This method is invoked after deleting a record.
     * @throws \yii\base\ErrorException
     * @throws \Exception
     */
    public function afterDelete()
    {
        $attribute = $this->attribute;
        if ($this->unlinkOnDelete) {
            (!$attribute || $this->deleteBasePathOnDelete) ? $this->deleteDir($this->deleteFromCDN) : $this->delete($attribute, false, $this->deleteFromCDN);
        }
    }

    /**
     * Returns file path for the attribute.
     * @param string $attribute
     * @param boolean $old
     * @param bool $append_file_name
     * @return string|null the file path.
     */
    public function getUploadPath($attribute, $old = false, $append_file_name = true)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;

        $path = $this->resolvePath($this->path);
        if ($model->hasAttribute($attribute)) {
            $fileName = ($old === true) ? $model->getOldAttribute($attribute) : $model->$attribute;
        } elseif (in_array($attribute, $this->extraAttributes)) {
            $fileName = ($old === true) ? $this->oldAttribute : $model->$attribute;
        }

        return $fileName ? Yii::getAlias($path . '/' . ($append_file_name ? $fileName : '')) : null;
    }

    /**
     * Returns CDN file path for the attribute.
     * @param string $attribute
     * @param boolean $old
     * @param bool $append_file_name
     * @return string|null the file path.
     */
    public function getCdnPath($attribute, $old = false, $append_file_name = true)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;

        $path = $this->resolvePath($this->cdnPath);
        if ($model->hasAttribute($attribute)) {
            $fileName = ($old === true) ? $model->getOldAttribute($attribute) : $model->$attribute;
        } elseif (in_array($attribute, $this->extraAttributes)) {
            $fileName = ($old === true) ? $this->oldAttribute : $model->$attribute;
        }

        return $fileName ? Yii::getAlias($path . '/' . ($append_file_name ? $fileName : '')) : null;
    }

    /**
     * Returns file url for the attribute.
     * @param string $attribute
     * @param string|null $x_oss_process
     * @return string|null
     */
    public function getUploadUrl($attribute, $x_oss_process = null, $inline = true, $fileName = '', $useOldAttribute = true, $setQueryParams = true)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        $url = $this->resolvePath($this->url);
        if (!$fileName) {
            if ($model->hasAttribute($attribute)) {
                $fileName = $useOldAttribute ? $model->getOldAttribute($attribute) : $model->getAttribute($attribute);
            } elseif (in_array($attribute, $this->extraAttributes)) {
                $fileName = $model->$attribute;
            }
        }

        $queryParams = ['x_oss_process' => $x_oss_process, 'inline' => $inline];

        return $fileName ? Yii::getAlias($url . '/' . $fileName . ($setQueryParams ? '?' . http_build_query($queryParams) : null)) : '';
    }

    /**
     * Returns the UploadedFile instance.
     * @return UploadedFile
     */
    protected function getUploadedFile()
    {
        return $this->_file;
    }

    /**
     * Replaces all placeholders in path variable with corresponding values.
     */
    protected function resolvePath($path)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        return preg_replace_callback('/{([^}]+)}/', function($matches) use ($model) {
            $name = $matches[1];
            $attribute = ArrayHelper::getValue($model, $name);
            if (is_string($attribute) || is_numeric($attribute)) {
                return $attribute;
            } else {
                return $matches[0];
            }
        }, $path);
    }

    /**
     * Saves the uploaded file.
     * @param UploadedFile $file the uploaded file instance
     * @param string $path the file path used to save the uploaded file
     * @return boolean true whether the file is saved successfully
     */
    protected function save($file, $path)
    {
        return $file->saveAs($path, $this->deleteTempFile);
    }

    /**
     * Deletes old file.
     * @param string $attribute
     * @param boolean $old
     * @param bool $deleteFromCDN
     * @throws \Exception
     */
    protected function delete($attribute, $old = false, $deleteFromCDN = false)
    {
        $path = $this->getUploadPath($attribute, $old);

        if (is_file($path)) {
            unlink($path);
        }

        if ($deleteFromCDN === true) {
            $cdn_path = $this->getCdnPath($attribute, $old);
            if ($cdn_path) {
                // Delete From CDN
                /** @var $cdn Cdn */
                $cdn = Yii::$app->Cdn;
                $cdn->debug = YII_DEBUG;
                $cdn_path = array_reverse(explode('/', trim($cdn_path, " \t\n\r\0\x0B/\\")));
                $cdn->delete(($cdn_path[0] ?? null), ($cdn_path[3] ?? null), ($cdn_path[2] ?? null), ($cdn_path[1] ?? null));
            }
        }
    }

    /**
     * Deletes basePath directory.
     * @param bool $deleteFromCDN
     * @throws \yii\base\ErrorException
     * @throws \Exception
     */
    protected function deleteDir($deleteFromCDN = true)
    {
        if ($this->basePath) {
            $basePath = Yii::getAlias($this->resolvePath($this->basePath));
            FileHelper::removeDirectory($basePath);
        }

        if ($deleteFromCDN === true) {
            $cdn_path = Yii::getAlias($this->resolvePath($this->cdnPath));
            if ($cdn_path) {
                // Delete From CDN
                /** @var $cdn Cdn */
                $cdn = Yii::$app->Cdn;
                $cdn->debug = YII_DEBUG;
                $cdn_path = array_reverse(explode('/', trim($cdn_path, " \t\n\r\0\x0B/\\")));
                $cdn->deleteDirectory(($cdn_path[2] ?? null), ($cdn_path[1] ?? null), ($cdn_path[0] ?? null));
            }
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFileName($file)
    {
        if ($this->generateNewName) {
            return $this->generateNewName instanceof Closure
                ? call_user_func($this->generateNewName, $file)
                : $this->generateFileName($file);
        } else {
            return $this->sanitize($file->name);
        }
    }

    /**
     * Replaces characters in strings that are illegal/unsafe for filename.
     *
     * #my*  unsaf<e>&file:name?".png
     *
     * @param string $filename the source filename to be "sanitized"
     * @return boolean string the sanitized filename
     */
    public static function sanitize($filename)
    {
        return str_replace([' ', '"', '\'', '&', '/', '\\', '?', '#'], '-', $filename);
    }

    /**
     * Generates random filename.
     * @param UploadedFile $file
     * @return string
     */
    protected function generateFileName($file)
    {
        return uniqid() . '.' . $file->extension;
    }

    /**
     * This method is invoked after uploading a file.
     * The default implementation raises the [[EVENT_AFTER_UPLOAD]] event.
     * You may override this method to do postprocessing after the file is uploaded.
     * Make sure you call the parent implementation so that the event is raised properly.
     * @throws \Exception
     */
    public function afterUpload()
    {
        $this->owner->trigger(self::EVENT_AFTER_UPLOAD);

        if ($this->transferToCDN) {
            // Transfer To CDN
            /** @var BaseActiveRecord $model */
            $model = $this->owner;
            /** @var $cdn Cdn */
            $cdn = Yii::$app->Cdn;
            $cdn->debug = YII_DEBUG;
            $source_path = $model->getUploadPath($this->attribute, false, false);
            $cdn_path = $model->getCdnPath($this->attribute, false, false);
            $cdn_path = array_reverse(explode('/', trim($cdn_path, " \t\n\r\0\x0B/\\")));
            $hasModelId = (int)$cdn_path[0] > 0;
            $transferToCdnResult = $cdn->upload(
                $source_path, $model->{$this->attribute},
                $hasModelId ? $cdn_path[2] : $cdn_path[1],
                $hasModelId ? $cdn_path[1] : $cdn_path[0],
                $hasModelId ? $cdn_path[0] : null,
                $this->convertImageToWebp);

            if ($transferToCdnResult['status'] != 200) {
                throw new InvalidParamException("Cannot transfer file to CDN.");
            } else {
                preg_match('/\.\w+$/', $model->{$this->attribute}, $matches);
                if ($this->convertImageToWebp && ArrayHelper::isIn(($matches[0] ?? ''), ['.png', '.jpg', '.jpeg'])) {
                    $fileName = str_replace(($matches[0] ?? ''), '.webp', $model->{$this->attribute});
                    $model->{$this->attribute} = $fileName;
                    if ($model->hasAttribute($this->attribute) && $model instanceof ActiveRecord) {
                        $collection = $model->getCollection();
                        $collection->update(['_id' => $model->_id], ["$this->attribute" => "$fileName"]);
                    } elseif ($model->hasAttribute($this->attribute)) {
                        Yii::$app->db->createCommand("UPDATE " . get_class($model)::tableName() . " SET $this->attribute='$fileName' WHERE id=$model->id")->execute();
                    } elseif (in_array($this->attribute, $this->extraAttributes)) {
                        $ownerJsonAttribute = null;
                        if ($this->owner->jsonAttributes ?? null) {
                            foreach ($this->owner->jsonAttributes as $key => $jsonAttribute) {
                                foreach ($jsonAttribute as $attribute) {
                                    if ($attribute == $this->attribute) {
                                        $ownerJsonAttribute = $key;
                                        break 2;
                                    }
                                }
                            }
                        } elseif ($this->owner->fieldAdditional ?? null) {
                            $ownerJsonAttribute = $this->owner->fieldAdditional;
                        }
                        Yii::$app->db->createCommand("UPDATE " . get_class($model)::tableName() . " SET `$ownerJsonAttribute`=JSON_SET(`$ownerJsonAttribute`, '$.$this->attribute', '$fileName') WHERE id=$model->id")->execute();
                    }
                }

                if ($this->unlinkOnTransferToCDN) {
                    $attribute = $this->attribute;
                    $this->deleteBasePathOnDelete ? $this->deleteDir(false) : $this->delete($attribute); // Delete file after transfer to CDN
                }
            }
            return $transferToCdnResult['status'] == 200;
        }

        return true;
    }
}