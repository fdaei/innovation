<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Notification $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'> <?= $form->field($model, 'user_id')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'type')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'created_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'created_by')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'updated_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'updated_by')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'update_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'response')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'priority')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'send_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'status')->textInput() ?>

        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
