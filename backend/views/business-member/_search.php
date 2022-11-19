<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessMemberSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-3">
    <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'last_name') ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'image') ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'position') ?>
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3">
    <?php // echo $form->field($model, 'business_id') ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
