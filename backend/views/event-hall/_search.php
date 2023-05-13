<?php

use common\models\Branches;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventHallSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-hall-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?=
            $form->field($model, 'branche_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Branches::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('app', 'Select Branches')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'capacity') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'description') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'rules') ?>
        </div>
        <div class="col-md-3">
            <?php // echo $form->field($model, 'specifications') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary ']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
