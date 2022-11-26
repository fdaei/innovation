<?php

use common\models\City;
use common\models\Province;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\City $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3'>
            <?= $form->field($model, 'province_id')->dropDownList(
                ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                ['prompt' => 'Select Province']
            ) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'latitude')->textInput() ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'longitude')->textInput() ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'status')->dropDownList(City::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
