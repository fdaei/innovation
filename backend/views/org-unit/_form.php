<?php

use common\models\OrgUnit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrgUnit $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="org-unit-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3'>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(OrgUnit::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
