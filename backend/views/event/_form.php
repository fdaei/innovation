<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;


/** @var yii\web\View $this */
/** @var common\models\Event $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="event-form">
    <?php $form = ActiveForm::begin(['id' => 'event_form']); ?>
    <div class="card card-body">
        <div class="row justify-content-center">
            <div class='col-md-4 '>
                <?= $form->field($model, 'event_organizer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Event::getOrganizerList(), 'id', 'organizer_name')) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'title_brief')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'evand_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'price_before_discount')->textInput() ?>
            </div>

            <div class='col-md-6 '>
                <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-6 '>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'status')->dropDownList(\common\models\Event::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
            </div>
            <div class='col-md-6 '>
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
            <span class='col-md-6'>
                 <p class="card-title border-bottom">
                <div id="map" style="width: 100%;height: 400px;"></div>
                </p>
            <?= $form->field($model, 'longitude')->textInput(['style' => 'display: none'])->label(false) ?>
                <?= $form->field($model, 'latitude')->textInput(['style' => 'display: none'])->label(false) ?>
        </span>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex ">
        <div class="float-right">
            <div>
                <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>
