<?php

use common\models\Statuses;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentor-form">

    <?php $form = ActiveForm::begin(['id'=>'mentor_form']); ?>
    <div class="row justify-content-center">

        <div class='col-md-3'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
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
        <div class='col-md-3'>
            <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'consultation_face_to_face_cost')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'consultation_online_cost')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'consultation_face_to_face_status')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'consultation_online_status')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'telegram')->fileInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(\common\models\Mentor::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
