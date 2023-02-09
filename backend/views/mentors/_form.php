<?php

use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Mentors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentors-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'>
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
        <div class='col-md-8'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'profile_pic')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'consulting_fee')->textInput() ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'consultation_face_to_face')->textInput() ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'consultation_online')->textInput() ?>
        </div>
        <div class='col-md-8'>
            <input type="text">
            <button type='button' class="add">Add</button>

            <button type='button' class="remove">remove</button>
            <div id="new_chq"></div>
            <input type="hidden" value="1" id="total_chq">
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'records')->textInput() ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'status')->textInput() ?>
        </div>

    </div>
</div>
<div class="form-group mb-0 card-footer d-flex justify-content-between">
    <div class="col-md-10 d-flex justify-content-end">
        <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
    </div>
</div>
<?php ActiveForm::end(); ?>

</div>
