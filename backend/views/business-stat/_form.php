<?php

use common\models\BusinessStat;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var BusinessStat $model */
/** @var ActiveForm $form */
?>

<div class="business-stat-form">
    <?php $form = ActiveForm::begin(['id' => 'business-stat-form']); ?>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList(BusinessStat::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'icon')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('height:96px width:96px'); ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>