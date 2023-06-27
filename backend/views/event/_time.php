<?php

use backend\models\EventTimes;
use common\models\Businesses;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var ActiveForm $form */
/** @var Businesses $model */
/** @var EventTimes[] $EventTimes */

$form = ActiveForm::begin(['id' => 'event_form_modal']);?>
<div class="card card-body">
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
                'formId' => 'event_form_modal',
                'formFields' => [
                    'start_at',
                    'end_at'
                ],
            ]); ?>
            <div class="container-items-time card">
                <div class="card-header">
                    <h3>زمان برگذاری رویداد</h3>
                    <div class="clearfix"></div>
                </div>
                <?php foreach ($EventTimes as $i => $time): ?>
                    <div class="item-time panel panel-default"><!-- widgetBody -->
                        <div class="panel-body card-body">
                            <?php
                            // necessary for update action.
                            if (!$time->isNewRecord) {
                                echo Html::activeHiddenInput($time, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="remove-item_time btn btn-danger btn-xs">حذف</button>
                                </div>
                                <!--                                        --><?php //endif;?>
                                <div class="col-sm-6">
                                    <?= $form->field($time, "[{$i}]start_at")->textInput(['maxlength' => true ,'value'=> $time->start_at ? Yii::$app->pdate->tr_num(Yii::$app->pdate->jdate('Y/m/d H:i',$time->start_at)):"",'data-jdp'=>true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($time, "[{$i}]end_at")->textInput(['maxlength' => true ,'value'=> $time->end_at ? Yii::$app->pdate->tr_num(Yii::$app->pdate->jdate('Y/m/d H:i',$time->end_at)):"",'data-jdp'=>true]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="add-item_time btn btn-success btn-xs">زمان جدید</button>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); // End the ActiveForm ?>
<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
            zIndex:2000,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>
