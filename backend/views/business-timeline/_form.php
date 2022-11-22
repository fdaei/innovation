<?php

use common\models\Business;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var BusinessTimeline $model */
/** @var yii\widgets\ActiveForm $form */
/** @var BusinessTimelineItem $TimelineItem */
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
            <?= $form->field($model, 'status')->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
        </div>
    </div>

    <div class="">
        <div class="card card-default">
            <div class="card-heading"><h4><i class="glyphicon glyphicon-envelope"></i> items</h4></div>
            <div class="card-body ">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $TimelineItem[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'status',
                        'description',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($TimelineItem as $i => $item): ?>
                        <div class="item card card-default"><!-- widgetBody -->
                            <div class="card-heading">
                                <div class="">
                                    <button type="button" class="add-item btn btn-success btn-xs">+</button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs">-</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                // necessary for update action.
                                if (!$item->isNewRecord) {
                                    echo Html::activeHiddenInput($item, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($item, "[{$i}]description")->textarea(['rows' => 6]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($item, "[{$i}]status")->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>