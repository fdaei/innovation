<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"><div class='col-md-3'> <?= $form->field($model, 'business_timeline_id')->textInput() ?>

  </div><div class='col-md-3'> <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

  </div><div class='col-md-3'> <?= $form->field($model, 'status')->textInput() ?>

  </div>    </div>    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
