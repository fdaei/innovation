<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Baner */
/* @var $form yii\widgets\ActiveForm */
$this->title = "تغییر کلمه عبور";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'old_password')->passwordInput() ?>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class=" col-md-4 col-sm-4 ">
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('ثبت', [
            'class' => 'btn btn-primary',
        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
