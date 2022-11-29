<?php

use common\models\JobPosition;
use common\models\OrgUnit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-position-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3'>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'org_unit_id')->dropDownList(
                ArrayHelper::map(OrgUnit::find()->all(), 'id', 'title'),
                ['prompt' => 'Select org_unit']
            ) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'requirements')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(JobPosition::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
