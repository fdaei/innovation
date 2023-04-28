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
    <?php $form = ActiveForm::begin(['id'=>'event_form']); ?>
    <div class="row justify-content-center">
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'picture')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'event_organizer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Event::getOrganizerList(),'id','organizer_name')) ?>
        </div>
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'title_brief')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'evand_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8 row justify-content-center'>
            <div class='col-md-6 p-0'>
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class='col-md-6 p-0'>
                <?= $form->field($model, 'price_before_discount')->textInput() ?>
            </div>
        </div>

<!--        <div class='col-md-8 kohl'>-->
<!--            --><?php //echo $form->field($model, 'sponsors')->textInput() ?>
<!--        </div>-->
        <div class='col-md-8 kohl' style="margin-top:60px">
            <div class="panel-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items-sponsors', // required: css class selector
                    'widgetItem' => '.item-sponsors', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item-sponsors', // css class
                    'deleteButton' => '.remove-item-sponsors', // css class
                    'model' => $eventSponsors[0],
                    'formId' => 'event_form',
                    'formFields' => [
                        'title',
                        'description'
                    ],
                ]); ?>
                <div class="container-items-sponsors"><!-- widgetContainer -->
                    <?php foreach ($eventSponsors as $i => $modelAddress): ?>
                        <div class="item-sponsors panel panel-default col-md-12" style="padding-right: 0px"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="remove-item-sponsors btn btn-danger btn-xs">حذف</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelAddress->isNewRecord) {
                                    echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class='col-sm-5'>
                                        <?= $form->field($modelAddress, "[{$i}]picture")->fileInput() ?>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($modelAddress, "[{$i}]instagram")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($modelAddress, "[{$i}]telegram")->textarea(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($modelAddress, "[{$i}]whatsapp")->textarea(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="add-item-sponsors btn btn-success btn-xs">حامی جدید</button>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

        <div class='col-md-8 kohl' style="margin-top:60px">
            <div class="panel-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items-headline', // required: css class selector
                    'widgetItem' => '.item-headline', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item-headline', // css class
                    'deleteButton' => '.remove-item-headline', // css class
                    'model' => $eventHeadlines[0],
                    'formId' => 'event_form',
                    'formFields' => [
                        'title',
                        'description'
                    ],
                ]); ?>
                <div class="container-items-headline"><!-- widgetContainer -->
                    <?php foreach ($eventHeadlines as $i => $modelAddress): ?>
                        <div class="item-headline panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="remove-item-headline btn btn-danger btn-xs">حذف</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelAddress->isNewRecord) {
                                    echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="add-item-headline btn btn-success btn-xs">سرفصل جدید</button>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

        <div class='col-md-8 kohl' style="margin-top:60px">
            <div class="panel-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items-time', // required: css class selector
                    'widgetItem' => '.item-time', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item_time', // css class
                    'deleteButton' => '.remove-item_time', // css class
                    'model' => $eventTimes[0],
                    'formId' => 'event_form',
                    'formFields' => [
                        'start',
                        'end'
                    ],
                ]); ?>
                <div class="container-items-time"><!-- widgetContainer -->
                    <?php foreach ($eventTimes as $i => $modelAddress): ?>
                        <div class="item-time panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="remove-item_time btn btn-danger btn-xs">حذف</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelAddress->isNewRecord) {
                                    echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelAddress, "[{$i}]start")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelAddress, "[{$i}]end")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
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




        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <span class='col-md-12'>
                 <p class="card-title border-bottom m-2 pb-3">
                <div id="map" style="width: 100%;height: 400px;"></div>
            </p>
            <?= $form->field($model, 'longitude')->textInput(['style' => 'display: none'])->label(false) ?>
            <?= $form->field($model, 'latitude')->textInput(['style' => 'display: none'])->label(false) ?>
        </span>

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
