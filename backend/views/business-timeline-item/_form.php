<?php

use common\models\BusinessTimeline;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-3">
        <?= $form->field($model, 'business_timeline_id')->dropDownList(
            ArrayHelper::map(BusinessTimeline::find()->all(), 'id', 'year'),
            ['prompt' => 'Select Bussines']
        ) ?>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="col-md-3">
        <?= $form->field($model, 'status')->dropDownList(['1' => 'active', '2' => 'inactive', '3' => 'deleted']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
