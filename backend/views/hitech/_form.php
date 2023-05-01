<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'required_skills')->textInput() ?>

    <?= $form->field($model, 'minimum_budget')->textInput() ?>

    <?= $form->field($model, 'maximum_budget')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
