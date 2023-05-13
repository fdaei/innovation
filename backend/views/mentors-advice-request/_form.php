<?php

use common\models\Mentor;
use common\models\MentorsAdviceRequest;
use common\models\Statuses;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequest $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mentors-advice-request-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-4'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
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
        <div class="col-md-6">
            <?=
            $form->field($model, 'mentor_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Mentor::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Select user')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer ">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
