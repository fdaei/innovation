<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Province $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'center_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                    'size' => Select2::MEDIUM,
                    'options' => ['placeholder' => Yii::t('app', 'CHOOSE OrgUnit')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'status')->dropDownList(Province::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
            </div>
        </div>
        <div class="form-group mb-0 card-footer d-flex justify-content-between">
            <div class="col-md-10 d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
