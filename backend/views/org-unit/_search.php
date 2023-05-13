<?php

use common\models\OrgUnit;
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
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(OrgUnit::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary ']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
