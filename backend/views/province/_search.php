<?php

use common\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ProvinceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="province-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-md-3">
            <?=
             $form->field($model, 'center_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Select city')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
