<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var \backend\models\MentorRecords $MentorRecords */
?>

<div class="mentor-form">
    <?php $form = ActiveForm::begin(['id' => 'mentor-records']); ?>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 20, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $MentorRecords[0],
        'formId' => 'mentor-records',
        'formFields' => [
            'title',
            'year',
            'description',
        ],
    ]); ?>
    <div class="container-items"><!-- widgetContainer -->
        <h2 class="mb-4">اضافه کردن رکورد</h2>
        <div class="text-right">
            <button type="button" class="add-item btn btn-success btn-xs ">add</button>
        </div>
        <?php foreach ($MentorRecords as $i => $record): ?>
            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$record->isNewRecord) {
                        echo Html::activeHiddenInput($record, "[{$i}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($record, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($record, "[{$i}]year")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($record, "[{$i}]description")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="panel-heading">
                            <button type="button" class="remove-item btn btn-danger btn-xs m-2">remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php DynamicFormWidget::end(); ?>
    <div class=" text-right">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>