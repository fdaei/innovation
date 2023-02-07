<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BranchesSpecificationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branches-specification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'key') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'value') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
