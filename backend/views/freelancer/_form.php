<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <div class='col-md-8 kohl'>
                <?= $form->field($model, 'freelancer_picture')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                ]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class='col-md-8 kohl'>
                <?= $form->field($model, 'header_picture_mobile')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                ]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class='col-md-8 kohl'>
                <?= $form->field($model, 'header_picture_desktop')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                ]) ?>
            </div>
        </div>
    </div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'province')->textInput() ?>

    <?= $form->field($model, 'marital_status')->textInput() ?>

    <?= $form->field($model, 'military_service_status')->textInput() ?>

    <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'record_job')->textInput() ?>

    <?= $form->field($model, 'record_educational')->textInput() ?>

    <?= $form->field($model, 'portfolio')->textInput() ?>

    <?= $form->field($model, 'description_user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project_number')->textInput() ?>

    <div class="col-md-8">
        <?= $form->field($model, 'status')->dropDownList(\common\models\Freelancer::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
