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
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'name')->textInput(['class' => 'custom_input_search d-inline', 'placeholder' => Yii::t('app', 'Enter your name')]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'description_brief')->textInput(['class' => 'custom_input_search d-inline', 'placeholder' => Yii::t('app', 'Enter your name')]) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'telegram') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'whatsapp') ?>

    <?php // echo $form->field($model, 'statistics') ?>

    <?php // echo $form->field($model, 'services') ?>

    <?php // echo $form->field($model, 'investors') ?>



    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary custom_background_color rounded-pill ']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary custom_border rounded-pill ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
