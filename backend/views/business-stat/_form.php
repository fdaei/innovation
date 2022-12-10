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
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'business_id')->dropDownList(
                ArrayHelper::map(Business::find()->all(), 'id', 'title'),
                ['prompt' => 'Select Bussines']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'icon')->fileInput()->hint('طول باید 96 پیکسل و عرض باید 96 پیکسل باشد ') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(BusinessStat::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>