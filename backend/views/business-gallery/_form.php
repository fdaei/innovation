<?php

use common\models\Business;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessGallery $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-gallery-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'business_id')->dropDownList(
            ArrayHelper::map(Business::find()->all(), 'id', 'title'),
            ['prompt' => 'Select Bussines']
        ) ?>
    </div>
        <div class="col-md-3">
            <?= $form->field($model, 'image')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
