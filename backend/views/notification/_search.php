<?php

use common\models\Notification;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\NotificationSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="notification-search">

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
            $form->field($model, 'user_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'options' => ['placeholder' => Yii::t('app', 'Select user')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'type')->dropDownList(Notification::itemAlias('Type'),['prompt'=>Yii::t('app','Select Type')]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'text') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(Notification::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-info btn-rounded']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-info btn-rounded']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
