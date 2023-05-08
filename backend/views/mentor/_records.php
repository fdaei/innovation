<?php

use backend\models\MentorRecords;
use common\models\Businesses;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var ActiveForm $form */
/** @var Businesses $model */
/** @var MentorRecords[] $MentorRecords */

$form = ActiveForm::begin(['id' => 'mentor_form']); // Start the ActiveForm
?>

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
                'model' => $MentorRecords[0],
                'formId' => 'mentor_form',
                'formFields' => [
                    'title',
                    'description'
                ],
            ]); ?>
            <div class="container-items-statistics">
                <div>
                    <h2 class="mb-4">اضافه کردن آمار</h2>
                    <button type="button"
                            class="add-item-statistics btn  btn-xs float-right rounded-pill custom_background_color text-white">
                        آمار جدید
                    </button>
                </div>
                <?php foreach ($MentorRecords as $i => $record): ?>
                    <div class="item-statistics panel panel-default" style="padding-right: 0px">
                        <div class="panel-body">
                            <?php
                            if (!$record->isNewRecord) {
                                echo Html::activeHiddenInput($record, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($record, "[{$i}]year")->textInput([ 'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($record, "[{$i}]title")->textInput([ 'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12">
                                    <?= $form->field($record, "[{$i}]description")->textarea(['rows' => 6, 'maxlength' => true]) ?>
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
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> <!-- Add a submit button -->
<?php ActiveForm::end(); // End the ActiveForm ?>