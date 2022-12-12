<?php

use common\models\Business;
use common\models\BusinessGallery;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessGallery $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-gallery-form">

    <?php $form = ActiveForm::begin([
        'id' => 'business-gallery-form',
        'options' => [

        ]
    ]); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
            <?=
            $form->field($model, 'business_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Business::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'status')->dropDownList(BusinessGallery::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'image')->hint('طول باید 348 و عرض باید 648 باشد')->fileInput() ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'mobile_image')->hint('طول باید 224 و عرض باید 316 باشد')->fileInput() ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
