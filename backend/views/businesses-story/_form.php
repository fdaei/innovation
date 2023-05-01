<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessesStory $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-story-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texts')->textInput(['maxlength' => true]) ?>

    <div class='col-md-12'>
        <?= $form->field($model, 'picture')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
