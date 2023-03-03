<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MentorSearch $model */
/** @var yii\widgets\ActiveForm $form */
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
        <div class="col-md-3">
            <?= $form->field($model, 'mobile') ?>
        </div>
<!--        <div class="col-md-3">-->
<!--            --><?php //= $form->field($model, 'resume') ?>
<!--        </div>-->
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
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
