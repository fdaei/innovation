<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
/** @var \backend\models\MentorRecords $MentorRecords */
?>

<div class="mentor-form">
    <?php $form = ActiveForm::begin(['id' => 'mentor-records']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
        <div class="panel-body">
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
                <div>
                    <h2 class="mb-4">اضافه کردن رکورد</h2>
                    <button type="button" class="add-item btn btn-success btn-xs">add</button>
                    رکورد جدید
                    </button>
                </div>
                <?php foreach ($MentorRecords as $i => $record): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">records</h3>
                            <div class="pull-right">

                                <button type="button" class="remove-item btn btn-danger btn-xs">remove</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $record->isNewRecord) {
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
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> <!-- Add a submit button -->
        </div>
        <?php ActiveForm::end(); ?>
</div>