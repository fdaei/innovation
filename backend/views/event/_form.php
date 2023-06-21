<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;
use yii\widgets\MaskedInput;


/** @var yii\web\View $this */
/** @var common\models\Event $model */
/** @var yii\bootstrap4\ActiveForm $form */
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
            <?= $form->field($model, 'price')->widget(MaskedInput::class,
                [
                    'options' => [
                        'autocomplete' => 'off',
                    ],
                    'clientOptions' => [
                        'alias' => 'integer',
                        'groupSeparator' => ',',
                        'autoGroup' => true,
                        'removeMaskOnSubmit' => true,
                        'autoUnmask' => true,
                    ],
                ])->label('قیمت (تومان)') ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'price_before_discount')->widget(MaskedInput::class,
                    [
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                        'clientOptions' => [
                            'alias' => 'integer',
                            'groupSeparator' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            'autoUnmask' => true,
                        ],
                    ])->label('قیمت قبل از تخفیف (تومان)') ?>
            </div>
            <div class='col-md-12 kohl' style="">
                <div class="panel-body ">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items-time', // required: css class selector
                        'widgetItem' => '.item-time', // required: css class
                        'limit' => 20, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item_time', // css class
                        'deleteButton' => '.remove-item_time', // css class
                        'model' => $EventTimes[0],
                        'formId' => 'event_form',
                        'formFields' => [
                            'start',
                            'end'
                        ],
                    ]); ?>
                    <div class="container-items-time"><!-- widgetContainer -->
                        <?php foreach ($EventTimes as $i => $time): ?>
                            <div class="item-time panel panel-default"><!-- widgetBody -->
                                <div>
                                    <div class="pull-right">
                                        <button type="button" class="remove-item_time btn btn-danger btn-xs">حذف</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    // necessary for update action.
                                    if (! $time->isNewRecord) {
                                        echo Html::activeHiddenInput($time, "[{$i}]id");
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= $form->field($time, "[{$i}]start")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($time, "[{$i}]end")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
                                        </div>
                                    </div><!-- .row -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-item_time btn btn-success btn-xs">زمان جدید</button>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
            <div class='col-md-6 '>
                <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-6 '>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
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
