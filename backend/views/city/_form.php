<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var City $model */
/** @var ActiveForm $form */
?>
<div class="card">
    <?php $form = ActiveForm::begin(['id'=>'create-city-form']); ?>
    <div class="card-body">
        <div>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'province_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'size' => Select2::MEDIUM,
                'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $form->field($model, 'latitude')->textInput() ?>
            <?= $form->field($model, 'longitude')->textInput() ?>
        </div>

    </div>
    <div class="card-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
