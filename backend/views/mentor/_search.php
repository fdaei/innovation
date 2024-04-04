<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MentorSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="mentor-search">

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
<!--        <div class="col-md-3">-->
<!--            --><?php //=  $form->field($model, 'instagram') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'linkedin') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'twitter') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'status') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'user_id') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'whatsapp') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'telegram') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'activity_field') ?>
<!--        </div>-->
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'activity_description') ?>
<!--        </div>-->
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary ']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
