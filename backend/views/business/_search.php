<?php

use common\models\BusinessSearch;
use common\models\City;
use common\models\User;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var BusinessSearch $model */
/** @var ActiveForm $form */
?>

<div class="business-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?=
             $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'options' => ['placeholder' => 'Select user'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'city_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Select city'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'title') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>