<?php

use common\widgets\RsScale;
use yii\base\DynamicModel;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model DynamicModel */
?>
<div class="card material-card">
    <div class="card-body">
        <?php
        $form = ActiveForm::begin([
            'id' => 'scale-form',
            'options' => [
                'data-pjax' => true,
            ]
        ]);
        ?>

        <?= $form->field($model, 'weight')->widget(RsScale::class, [
            //'url' => "ws://" . Yii::$app->user->identity->scale->ip,
            'url' => "ws://localhost:1444",
            'options' => [
                'class' => 'dir-ltr form-control',
            ]
        ]) ?>

        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-block']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>