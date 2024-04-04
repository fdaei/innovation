<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizerSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="event-teachers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-3">
        <?= $form->field($model, 'organizer_name') ?>
    </div>


<!--    --><?php //= $form->field($model, 'organizer_title_brief') ?>

    <?php // echo $form->field($model, 'organizer_instagram') ?>

    <?php // echo $form->field($model, 'organizer_telegram') ?>

    <?php // echo $form->field($model, 'organizer_linkedin') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
