<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_main_desktop')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_main_mobile')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_small1_desktop')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_small1_mobile')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_small2_desktop')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'pic_small2_mobile')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
        <div class="form-group m-2">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
