<?php

use common\models\Business;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var BusinessTimeline $model */
/** @var ActiveForm $form */
/** @var BusinessTimelineItem $TimelineItem */
?>

<div class="business-timeline-form">

    <?php $form = ActiveForm::begin(['id' => 'business-timeline-form']); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(
                    BusinessTimeline::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'year')->textInput() ?>
        </div>
    </div>

    <div class="">
        <div class="card card-default">
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
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <button type="button" class="add-item btn btn-info btn-xs btn-rounded"><?=Yii::t('app', 'add')?></button>
                                    <button type="button" class="remove-item btn btn-outline-info btn-rounded btn-xs"><?=Yii::t('app', 'remove')?></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                // necessary for update action.
                                if (!$item->isNewRecord) {
                                    echo Html::activeHiddenInput($item, "[{$i}]id");
                                }
                                ?>
                                <div class="row justify-content-center">
                                    <div class="col-sm-4">
                                        <?= $form->field($item, "[{$i}]description")->textarea(['rows' => 6]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($item, "[{$i}]status")->dropDownList(Business::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
            <div class="form-group mb-0 card-footer d-flex justify-content-between">
                <div class="col-md-10 d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>