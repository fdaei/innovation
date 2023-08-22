<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequestSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="mentors-advice-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'mobile') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'mentor_id')->widget(Select2::classname(), [
                'initValueText' => $model->mentor ? $model->mentor->name : '', // Assuming mentor is a relation in your model
                'options' => ['placeholder' => 'جستجوی مشاور...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 2,
                    'ajax' => [
                        'url' => Url::to(['/mentor/search-mentors']),
                        'dataType' => 'json',
                        'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                    ],
                ],
            ])->label('نام مشاوره'); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
