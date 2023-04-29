<?php

use common\models\Statuses;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentor-form">

    <?php $form = ActiveForm::begin(['id'=>'mentor_form']); ?>
    <div class="card card-body">
        <div class="row">
            <div class='col-md-4'>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?=
                $form->field($model, 'status')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Statuses::find()->onCondition(['type'=>'mentor'])->all(), 'id', 'title_fa'),
                    'options' => ['placeholder' => Yii::t('app', 'Select Mentor')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class='col-md-4'>
                <?=
                $form->field($model, 'user_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => Yii::t('app', 'Select user')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4'>
                <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="card card-body">
        <div class="row">
        <div class='col-md-12 kohl' style="margin-top:60px">
            <div class="panel-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container_items_service', // required: css class selector
                    'widgetItem' => '.item_service', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add_item_service', // css class
                    'deleteButton' => '.remove_item_service', // css class
                    'model' => $mentorServices[0],
                    'formId' => 'mentor_form',
                    'formFields' => [
                        'title',
                        'description'
                    ],
                ]); ?>
                <div class="container_items_service"><!-- widgetContainer -->
                    <?php foreach ($mentorServices as $i => $modelAddress): ?>
                        <div class="item_service panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="remove_item_service btn btn-danger btn-xs">حذف</button>
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
                                    <div class='col-sm-3'>
                                        <?= $form->field($modelAddress, "[{$i}]picture")->fileInput() ?>
                                    </div>
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
                <button type="button" class="add_item_service btn btn-success btn-xs">خدمت جدید</button>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
        <div class='col-md-12 kohl' style="margin-top:60px">
            <div class="panel-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container_items_records', // required: css class selector
                    'widgetItem' => '.item_records', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add_item_records', // css class
                    'deleteButton' => '.remove_item_records', // css class
                    'model' => $mentorRecords[0],
                    'formId' => 'mentor_form',
                    'formFields' => [
                        'year',
                        'title',
                        'description'
                    ],
                ]); ?>
                <div class="container_items_records"><!-- widgetContainer -->
                    <?php foreach ($mentorRecords as $i => $modelAddress): ?>
                        <div class="item_records panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="remove_item_records btn btn-danger btn-xs">حذف</button>
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
                                    <div class="col-sm-2">
                                        <?= $form->field($modelAddress, "[{$i}]year")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="add_item_records btn btn-success btn-xs">سابقه جدید</button>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
        <div class='col-md-4'>
            <?= $form->field($model, 'picture_mentor')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'picture')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'video')->widget(FileInput::class, [
                'name' => 'attachment_3',
            ]) ?>
        </div>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
