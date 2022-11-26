<?php

use common\models\Business;
use common\models\BusinessStat;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessStat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-stat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
    <?= $form->field($model,'business_id')->dropDownList(
        ArrayHelper::map(Business::find()->all(),'id','title'),
        ['prompt'=>'Select Bussines']
    )?>
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

    <?= $form->field($model, 'icon')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(BusinessStat::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
