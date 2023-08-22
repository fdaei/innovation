<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'update profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" text-center bg-center">
    <div class="row justify-content-center bg-white  p-2">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput()->hint(' اگر نمیخواهید پسورد خود را بروز رسانی کنید  پسورد قبلی خود را وارد کنید');  ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-info']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>