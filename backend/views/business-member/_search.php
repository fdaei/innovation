<?php

use common\models\BusinessMemberSearch;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/** @var View $this */
/** @var BusinessMemberSearch $model */
/** @var ActiveForm $form */
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