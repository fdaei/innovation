<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\LogSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?php //= $form->field($model, 'id') ?>
<!---->
<!--    --><?php //= $form->field($model, 'level') ?>
<!---->
<!--    --><?php //= $form->field($model, 'category') ?>
    <div class="row">
        <div class="col-md-3">
    <?= $form->field($model, 'log_time') ?>
        </div>
    </div>

<!--    --><?php //= $form->field($model, 'prefix') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'message') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
