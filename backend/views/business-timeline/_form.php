<?php

use common\models\Business;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BusinessTimeline $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-timeline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'business_id')->dropDownList(
        ArrayHelper::map(Business::find()->all(),'id','title'),
        ['prompt'=>'Select Bussines']
    )?>
    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model,'status')->dropDownList( ['1' => 'active', '2' => 'inactive', '3' => 'deleted'])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
