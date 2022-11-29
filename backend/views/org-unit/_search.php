<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrgUnitSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="org-unit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row"><div class="col-md-3">    <?= $form->field($model, 'id') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'title') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'description') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'status') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'created_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'deleted_at') ?>

</div>    </div>    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
