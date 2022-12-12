<?php

use common\models\Business;
use common\models\BusinessStat;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var BusinessStat $model */
/** @var ActiveForm $form */
?>

<div class="business-stat-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'business_id')->dropDownList(
                ArrayHelper::map(Business::find()->all(), 'id', 'title'),
                ['prompt' => 'Select Bussines']
            ) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">

            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'icon')->hint('طول باید 96 و عرض باید 96 باشد')->fileInput() ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(BusinessStat::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>