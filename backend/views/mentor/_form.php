<?php

use common\models\Statuses;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentor-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-4'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>

        <div class='col-md-4'>
            <?= $form->field($model, 'job_records')->textInput() ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'education_records')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'status')->widget(Select2::class, [
                'data' => ArrayHelper::map(Statuses::find()->onCondition(['type'=>'mentor'])->all(), 'id', 'title_fa'),
                'options' => ['placeholder' => Yii::t('app', 'Select Mentor')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class='col-md-4'>
            <?=
            $form->field($model, 'user_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'options' => ['placeholder' => Yii::t('app', 'Select user')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'consulting_fee')->textInput() ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'consultation_face_to_face')->textInput() ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'consultation_online')->textInput() ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'services')->textInput() ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'records')->textInput() ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'documents')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-4'>

            <?= $form->field($model, 'resume')->widget(FileInput::class, [
                'options' => ['accept' => 'file/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'picture')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'video')->widget(FileInput::class, [
                'name' => 'attachment_3',
            ]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
