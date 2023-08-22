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

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'log_time_start')->textInput(['maxlength' => true, 'data-jdp' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'log_time_end')->textInput(['maxlength' => true, 'data-jdp' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>

