<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CareerApplySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="career-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row"><div class="col-md-3">    <?= $form->field($model, 'id') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'user_id') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'first_name') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'last_name') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'mobile') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'email') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'job_position_id') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'cv_file') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'description') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'status') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_by') ?>

</div>    </div>    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
