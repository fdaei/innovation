<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Province $model */
/** @var ActiveForm $form */
?>

<div class="card">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
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
        </div>
    </div>
    <div class="form-group card-footer">
        <div >
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
