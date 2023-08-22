<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventHallPriceListSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="event-hall-price-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">    <?= $form->field($model, 'id') ?>

        </div>
        <div class="col-md-3">    <?= $form->field($model, 'event_hall_id') ?>

        </div>
        <div class="col-md-3">    <?= $form->field($model, 'day') ?>

        </div>
        <div class="col-md-3">    <?= $form->field($model, 'price') ?>

        </div>
        <div class="col-md-3">    <?= $form->field($model, 'created_at') ?>

        </div>
        <div class="col-md-3">    <?php // echo $form->field($model, 'created_by') ?>

        </div>
        <div class="col-md-3">    <?php // echo $form->field($model, 'updated_at') ?>

        </div>
        <div class="col-md-3">    <?php // echo $form->field($model, 'updated_by') ?>

        </div>
        <div class="col-md-3">    <?php // echo $form->field($model, 'deleted_at') ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
