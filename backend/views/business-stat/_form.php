<?php

use backend\models\Business;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BusinessStat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-stat-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model,'business_id')->dropDownList(
        ArrayHelper::map(Business::find()->all(),'id','title'),
        ['prompt'=>'Select Bussines']
    )?>
    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'status')->dropDownList( ['1' => 'active', '2' => 'inactive', '3' => 'deleted'])?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
