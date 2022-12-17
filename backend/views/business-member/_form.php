<?php

use common\models\Business;
use common\models\BusinessMember;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var common\models\BusinessMember $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-member-form">

    <?php $form = ActiveForm::begin(
            ['id' => 'business-member-form',]
    ); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(BusinessMember::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint(' طول باید 248 و عرض باید 268 باشد'); ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
