<?php

use common\models\Activity;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Activity $model */
/** @var yii\widgets\ActiveForm $form */
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
                <?= $form->field($model, 'status')->dropDownList(Activity::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
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
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
            </div>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>