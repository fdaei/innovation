<?php

use common\models\BusinessesStory;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var BusinessesStory $model */
/** @var ActiveForm $form */
?>

<div class="businesses-story-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texts')->textInput(['maxlength' => true]) ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>