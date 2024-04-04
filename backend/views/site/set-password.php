<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'رمز دو مرحله ای';
?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'options' => [
            'tag' => 'span',
            'style' => 'width: 100%;',
        ],
    ],
]);
?>
<h2 class="form-signin-heading text-center">ثبت کلمه عبور دو مرحله ای</h2>
<div class="login-wrap">
    <div class="col-md-12">
        <?= $form->field($model, 'password', ['inputOptions' => ['autocomplete' => 'off',]])->passwordInput([
            'placeholder' => 'لطفا رمز دو مرحله ای را وارد کنید...',
            'autofocus' => 'autofocus'
        ]) ?>
    </div>
    <div class="form-group mt-3">
        <?= Html::submitButton('ورود', ['class' => 'btn btn-lg btn-success btn-block', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

