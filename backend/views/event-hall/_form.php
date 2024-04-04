<?php

use common\models\Branches;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventHall $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="event-hall-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-3'>
            <?=
            $form->field($model, 'branche_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Branches::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('app', 'Select Branches')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'capacity')->textInput() ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'specifications')->textInput() ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'rules')->textarea(['rows' => 6]) ?>
        </div>
        <span class='col-md-12'>
                 <p class="card-title border-bottom m-2 pb-3">
                <div id="map" style="width: 100%;height: 400px;"></div>
            </p>
            <?= $form->field($model, 'longitude')->textInput(['style' => 'display: none'])->label(false) ?>
            <?= $form->field($model, 'latitude')->textInput(['style' => 'display: none'])->label(false) ?>
        </span>
    </div>
    <div class="form-group card-footer ">
        <div>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
