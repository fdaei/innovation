<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'business_color')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'business_en_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'description_brief')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, "business_logo")->label(false)->widget(FileInput::class, [
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
                    'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("business_logo")) ? $model->getUploadUrl("business_logo") : false,
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
