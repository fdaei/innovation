<?php

use common\models\Business;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessMember $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-member-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'business_id')->dropDownList(
                ArrayHelper::map(Business::find()->all(), 'id', 'title'),
                ['prompt' => 'Select Bussines']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'image')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
