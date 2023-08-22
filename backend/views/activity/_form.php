<?php

use common\models\Activity;
use common\models\Statuses;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Activity $model */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var common\models\ActivityUserAssignment $assignment */
?>

<div class="activity-form">
    <?php $form = ActiveForm::begin(['enableClientValidation' => true,
        'options' => [
            'id' => 'dynamic-form'
        ]]); ?>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-8">
                <?=
                $form->field($assignment, 'user_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => Yii::t('app', 'Select user')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?=
                $form->field($model, 'status')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Statuses::find()->onCondition(['type'=>'activity'])->all(), 'id', 'title_fa'),
                    'options' => ['placeholder' => Yii::t('app', 'Select Status')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'send_sms')->checkbox() ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'send_email')->checkbox() ?>
            </div>

        </div>

        <div class="form-group mb-0 card-footer d-flex justify-content-between">
            <div class="col-md-10 d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>