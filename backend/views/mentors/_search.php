<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MentorsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'telegram') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'instagram') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'whatsapp') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'activity_field') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'profile_pic') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'activity_description') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'consulting_fee') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'consultation_face_to_face') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'consultation_online') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'services') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'records') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'status') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
