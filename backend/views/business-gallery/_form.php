<?php

use common\models\Business;
use common\models\BusinessGallery;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessGallery $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-gallery-form">

    <?php $form = ActiveForm::begin([
        'id' => 'business-gallery-form',
        'options' => [

        ]
    ]); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(BusinessGallery::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('height:648 width:348'); ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'mobile_image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('height:316px width:224px'); ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
