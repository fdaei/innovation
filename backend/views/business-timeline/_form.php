<?php

use common\models\Business;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BusinessTimeline $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'business_id')->dropDownList(
                ArrayHelper::map(Business::find()->all(), 'id', 'title'),
                ['prompt' => 'Select Bussines']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'year')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsAddress[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'full_name',
                        'address_line1',
                        'address_line2',
                        'city',
                        'state',
                        'postal_code',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsAddress as $i => $modelAddress): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Address</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelAddress, "[{$i}]full_name")->textInput(['maxlength' => true]) ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelAddress, "[{$i}]address_line1")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelAddress, "[{$i}]address_line2")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]city")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]state")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]postal_code")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
