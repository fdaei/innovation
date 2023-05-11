<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-form">

    <?php $form = ActiveForm::begin(['id' =>'mentor-pic']); ?>
    <div class="row">
        <div class='col-md-12'>
            <?= $form->field($model, "picture_mentor")->label(false)->widget(FileInput::class, [
                'options' => [
                    'multiple' => false,
                    //'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showCancel' => false,
                    'theme' => 'explorer-fas',
                    'browseClass' => 'btn btn-primary btn-sm btn-preview',
                    'browseIcon' => '<i class="fas fa-file"></i> ',
                    'browseLabel' => Yii::t('app', 'Choose a file ...'),
                    'previewFileType' => 'image',
                    'initialPreviewAsData' => true,
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("picture_mentor")) ? $model->getUploadUrl("picture_mentor") : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, "picture")->label(false)->widget(FileInput::class, [
                'options' => [
                    'multiple' => false,
                    //'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showCancel' => false,
                    'theme' => 'explorer-fas',
                    'browseClass' => 'btn btn-primary btn-sm btn-preview',
                    'browseIcon' => '<i class="fas fa-file"></i> ',
                    'browseLabel' => Yii::t('app', 'Choose a file ...'),
                    'previewFileType' => 'image',
                    'initialPreviewAsData' => true,
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("picture")) ? $model->getUploadUrl("picture") : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, "video")->label(false)->widget(FileInput::class, [
                'options' => [
                    'multiple' => false,
                    //'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showCancel' => false,
                    'theme' => 'explorer-fas',
                    'browseClass' => 'btn btn-primary btn-sm btn-preview',
                    'browseIcon' => '<i class="fas fa-file"></i> ',
                    'browseLabel' => Yii::t('app', 'Choose a file ...'),
                    'previewFileType' => 'image',
                    'initialPreviewAsData' => true,
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("video")) ? $model->getUploadUrl("video") : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
        </div>
        <div class="form-group m-2">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
