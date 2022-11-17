<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BusinessTimelineSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'business_id') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'year') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'description') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
