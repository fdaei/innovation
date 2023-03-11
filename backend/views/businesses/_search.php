<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'picture_desktop') ?>

    <?= $form->field($model, 'picture_mobile') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description_brief') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'telegram') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'whatsapp') ?>

    <?php // echo $form->field($model, 'pic_main_desktop') ?>

    <?php // echo $form->field($model, 'pic_main_mobile') ?>

    <?php // echo $form->field($model, 'pic_small1_desktop') ?>

    <?php // echo $form->field($model, 'pic_small1_mobile') ?>

    <?php // echo $form->field($model, 'pic_small2_desktop') ?>

    <?php // echo $form->field($model, 'pic_small2_mobile') ?>

    <?php // echo $form->field($model, 'statistics') ?>

    <?php // echo $form->field($model, 'services') ?>

    <?php // echo $form->field($model, 'investors') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
