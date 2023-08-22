<?php


use backend\models\BusinessStoryText;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var BusinessesStory $model */
/** @var BusinessStoryText $businessesText */
/** @var ActiveForm $form */
?>

<div class="businesses-story-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="row bg-white p-3 rounded my-3">
        <div class="card card-body">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper1',
                'widgetBody' => '.container-items-statistics',
                'widgetItem' => '.item-statistics',
                'limit' => 20,
                'min' => 1,
                'insertButton' => '.add-item-statistics',
                'deleteButton' => '.remove-item-statistics',
                'model' => $businessesText[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'title',
                ],
            ]); ?>
            <div class="container-items-statistics">
                <div>
                    <h2 class="mb-4">اضافه کردن </h2>
                    <button type="button"
                            class="add-item-statistics btn  btn-xs float-right rounded-pill custom_background_color text-white">
                         جدید
                    </button>
                </div>
                <?php foreach ($businessesText as $i => $text): ?>
                    <div class="item-statistics panel panel-default" style="padding-right: 0px">
                        <div class="panel-body">
                            <?php
                            if (!$text->isNewRecord) {
                                echo Html::activeHiddenInput($text, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($text, "[{$i}]title")->textInput([ 'maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <button type="button"
                                        class="remove-item-statistics btn  btn-xs float-right rounded-pill btn-danger text-white">
                                    حذف
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
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
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>