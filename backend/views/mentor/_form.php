<?php

use common\models\Mentor;
use common\models\MentorCategory;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use common\models\MentorCategory;


/** @var View $this */
/** @var Mentor $model */
/** @var ActiveForm $form */
?>

<div class="mentor-form">

    <?php $form = ActiveForm::begin(['id' => 'mentor_form']); ?>
    <div class="row">
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
            <?= $form->field($model, 'user_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'options' => ['placeholder' => Yii::t('app', 'Select user')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
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
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(Mentor::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>

        <div class="col-sm-5">
            <?= $form->field($model, 'categories_list')
                ->label(Yii::t('app', 'Mentor Category'))
                ->widget(Select2::class, [
                    'data' => ArrayHelper::map(MentorCategory::find()->all(), 'id', 'title'),
                    'options' => ['placeholder' => 'Select a state ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],
                ]); ?>
        </div>
        <div class='col-md-12'>
            <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-start">
        <div class="col-md-10">
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>