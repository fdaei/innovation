<?php

use common\models\BusinessMember;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;


/** @var View $this */
/** @var BusinessMember $model */
/** @var ActiveForm $form */
?>

<div class="business-member-form">

    <?php $form = ActiveForm::begin(['id' => 'business-member-form',]); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(BusinessMember::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, "image")->widget(FileInput::class, [
                'options'             => ['accept' => ['image/png', 'image/jpeg']],
                'hashVarLoadPosition' => View::POS_READY, //cause of rendering the widget via `renderAjax`
                'pluginOptions'       => [
                    'showCaption'            => false,
                    'showRemove'             => false,
                    'showUpload'             => false,
                    'showCancel'             => false,
                    'theme'                  => 'explorer-fas',
                    'browseClass'            => 'btn btn-primary btn-sm btn-preview',
                    'browseIcon'             => '<i class="fas fa-camera"></i> ',
                    'browseLabel'            => 'انتخاب تصویر ...',
                    'previewFileType'        => 'image',
                    'initialPreviewAsData'   => true,
                    'initialPreview'         => (!$model->isNewRecord && $model->getUploadUrl('image')) ? $model->getUploadUrl('image') : false,
                    'initialPreviewFileType' => 'image',
                ]
            ])->hint('width:268px height:248px');
            ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
