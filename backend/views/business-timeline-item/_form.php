<?php

use common\models\Business;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var BusinessTimelineItem $model */
/** @var ActiveForm $form */
?>

<div class="business-timeline-item-form">

    <?php $form = ActiveForm::begin(['id' => 'business-timeline-item-form']); ?>
    <div class="row justify-content-center">
            <div class="col-md-8">
                <?=  $form->field($model, 'business_timeline_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(BusinessTimeline::find()->all(), 'id', 'year'),
                    'options' => ['placeholder' => 'Select a state ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        <div class='col-md-8'> <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'status')->dropDownList(BusinessTimelineItem::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
