<?php

use common\models\Business;
use common\models\BusinessGallery;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\web\View;


/** @var View $this */
/** @var BusinessGallery $model */
/** @var ActiveForm $form */
?>

<div class="business-gallery-form">

    <?php $form = ActiveForm::begin([
        'id' => 'business-gallery-form',
        'options' => [

        ]
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->dropDownList(BusinessGallery::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width:648 height:348'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'mobile_image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width:316px height:224px'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'tablet_image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width:1023px height:990px'); ?>
        </div>
    </div>
    <div class="form-group text-right">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>