<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'organizer_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'organizer_instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'organizer_telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'organizer_linkedin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'organizer_title_brief')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, "organizer_avatar")->label(false)->widget(FileInput::class, [
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
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("organizer_avatar")) ? $model->getUploadUrl("organizer_avatar") : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, "organizer_picture")->label(false)->widget(FileInput::class, [
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
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("organizer_picture")) ? $model->getUploadUrl("organizer_picture") : false,
                    'initialPreviewFileType' => 'image',
                ]
            ]) ?>
        </div>
    </div>











    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
