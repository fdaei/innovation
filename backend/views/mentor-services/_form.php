<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MentorServices $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="mentor-services-form">
    <div class="row">
        <div class="col-md-12 offset-md-2">
            <?php $form = ActiveForm::begin(['id' => 'mentor_service_form']); ?>

            <div class="mb-3">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="mb-3">
                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
            </div>

            <div class="mb-3">
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

            <div class="text-center">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
