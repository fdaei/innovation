<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BranchesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row"><div class="col-md-3">    <?= $form->field($model, 'id') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'title') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'address') ?>

</div>  <?php // echo $form->field($model, 'mobile') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'phone') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'desk_count') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'status') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'deleted_at') ?>

</div>    </div>    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
