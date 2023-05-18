<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Statuses $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="statuses-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'>
            <?= $form->field($model, 'title_fa')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'> <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?=
            $form->field($model, 'type')->widget(Select2::class, [
                'data' => $model->getModels(),
                'options' => ['placeholder' => Yii::t('app', 'Select user')],
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
