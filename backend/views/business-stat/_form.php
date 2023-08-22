<?php

use common\models\BusinessStat;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var BusinessStat $model */
/** @var ActiveForm $form */
?>

<div class="business-stat-form">
    <?php $form = ActiveForm::begin(['id' => 'business-stat-form']); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'icon')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('height:96px width:96px'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="text-right">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>