<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'organizer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_avatar')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_picture')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_title_brief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_telegram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_linkedin')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
