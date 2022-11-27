<?php

use common\models\Business;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'business_timeline_id')->dropDownList(
                    ArrayHelper::map(BusinessTimeline::find()->all(), 'id', 'year'),
                    ['prompt' => 'Select city']
                ) ?>
            </div>
        <div class='col-md-3'> <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'status')->dropDownList(BusinessTimelineItem::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
