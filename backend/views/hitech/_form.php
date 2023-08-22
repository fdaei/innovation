<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="card card-body">
    <?php $form = ActiveForm::begin(['id' => 'hitech_form']); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'minimum_budget')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'maximum_budget')->textInput() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>


    <div class="row bg-white p-3 rounded my-3">
        <div class="card card-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-required_skills', // required: css class selector
                'widgetItem' => '.item-required_skills', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-required_skills', // css class
                'deleteButton' => '.remove-item-required_skills', // css class
                'model' => $HitechRequireSkills[0],
                'formId' => 'hitech_form',
                'formFields' => [
                    'title',
                    'description'
                ],
            ]); ?>
            <div class="container-items-required_skills card"><!-- widgetContainer -->
                <div class="card-header">
                    <h3 class="mb-4 d-inline">اضافه کردن مهارت جدید</h3>
                    <button type="button" class="add-item-required_skills btn  btn-xs float-right  btn-success">
                     <i class="fa fa-plus"></i>
                    </button>
                </div>
                <?php foreach ($HitechRequireSkills as $i => $modelAddress): ?>
                    <div class="item-required_skills panel panel-default" style="padding-right: 0px"><!-- widgetBody -->
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                        <div class="">
                            <div class=" p-4">
                                <button type="button"
                                        class="remove-item-required_skills btn   float-right  btn-danger text-white">
                                  <i class="fa fa-minus"></i>
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


    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
