<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var City $model */
/** @var ActiveForm $form */
?>
<div class="card">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'province_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                    'size' => Select2::MEDIUM,
                    'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'latitude')->textInput() ?>
            </div>
            <div class='col-sm-3'>
                <?= $form->field($model, 'longitude')->textInput() ?>

            </div>
        </div>

    </div>
    <div class="card-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
