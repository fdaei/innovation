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
        <div class='col-md-6'>
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
        <div class='col-md-6'>
            <?=
            $form->field($model, 'mentor_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Mentor::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Select Mentor')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class='col-md-6'>
            <label><?=Yii::t('app', 'Date')?></label>
            <input type="text" id="mentorsadvicerequest-date_advice" class="form-control" name="MentorsAdviceRequest[date_advice]" aria-required="true" data-jdp>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'type')->dropDownList(MentorsAdviceRequest::itemAlias('TYPE'), ['prompt' => Yii::t('app', 'Select TYPE')]) ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'file')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'file/*'],
            ]); ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6'>
            <?=
            $form->field($model, 'status')->widget(Select2::class, [
                'data' => ArrayHelper::map(Statuses::find()->onCondition(['type'=>'mentors-advice-request'])->all(), 'id', 'title_fa'),
                'options' => ['placeholder' => Yii::t('app', 'Select Status')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    jalaliDatepicker.startWatch({
        time:true,
    })
</script>
