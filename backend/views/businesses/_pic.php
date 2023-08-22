<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="businesses-form">
    <?php $form = ActiveForm::begin(['id' => 'business-picture',]); ?>
    <div class="row bg-white p-3">
        <label>pic_main_desktop</label>
        <div class='col-md-12'>
            <?= $form->field($model, $filed)->label(false)->widget(FileInput::class, [
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
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl($filed)) ? $model->getUploadUrl($filed) : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
        <div class="form-group m-2">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
