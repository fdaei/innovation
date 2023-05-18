<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventSponsors $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="">

    <?php $form = ActiveForm::begin(['id' => 'businesses_form']); ?>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
