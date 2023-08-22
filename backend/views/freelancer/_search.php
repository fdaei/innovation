<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FreelancerSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="freelancer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-sm-6">
            <?php  echo $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-6">
            <?php  echo $form->field($model, 'email') ?>
        </div>
        <div class="col-sm-6">
            <?php  echo $form->field($model, 'mobile') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
