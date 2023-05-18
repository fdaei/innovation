<?php

use common\models\EventHallPriceList;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventHallPriceList $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="event-hall-price-list-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'>
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'day')->dropDownList(EventHallPriceList::itemAlias('Week'), ['prompt' => Yii::t('app', 'Select Day')]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
