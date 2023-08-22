<?php

use backend\models\MentorRecords;
use common\models\Businesses;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>

<?php
$form = ActiveForm::begin(['id' => 'event_form_headline']); // Start the ActiveForm
?>
<div class="card card-body">
    <div class='col-md-12 kohl' style="">
        <div class="panel-body ">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-headline', // required: css class selector
                'widgetItem' => '.item-headline', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-headline', // css class
                'deleteButton' => '.remove-item-headline', // css class
                'model' => $eventHeadlines[0],
                'formId' => 'event_form_headline',
                'formFields' => [
                    'title',
                    'description'
                ],
            ]); ?>
            <div class="container-items-headline"><!-- widgetContainer -->
                <?php foreach ($eventHeadlines as $i => $modelAddress): ?>
                    <div class="item-headline panel panel-default" style="padding-right: 0px"><!-- widgetBody -->
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
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
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
</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> <!-- Add a submit button -->

<?php ActiveForm::end(); // End the ActiveForm ?>