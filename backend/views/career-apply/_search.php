<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CareerApplySearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="career-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'last_name') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'mobile') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary ']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
