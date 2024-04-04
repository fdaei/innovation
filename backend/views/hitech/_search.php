<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\HitechSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="hitech-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
    <?= $form->field($model, 'title') ?>
        </div>
    </div>

<!--    --><?php //= $form->field($model, 'description') ?>

<!--    --><?php //= $form->field($model, 'required_skills') ?>

<!--    --><?php //= $form->field($model, 'minimum_budget') ?>

    <?php // echo $form->field($model, 'maximum_budget') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
