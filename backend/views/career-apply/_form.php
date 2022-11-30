<?php

use common\models\CareerApply;
use common\models\JobPosition;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CareerApply $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="career-apply-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3'>
            <?= $form->field($model, 'user_id')->dropDownList(
                ArrayHelper::map(User::find()->all(), 'id', 'username'),
                ['prompt' => 'Select user']
            ) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'job_position_id')->dropDownList(
                ArrayHelper::map(JobPosition::find()->all(), 'id', 'title'),
                ['prompt' => 'Select user']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'cv_file')->fileInput() ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(CareerApply::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
