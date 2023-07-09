<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;
use yii\web\View;

/** @var View $this */
/** @var common\models\FreelancerCategoryList $model */
/** @var ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
<!--        <div class="col-md-6">-->
<!--        </div>-->
        <div class="col-md-6">
            <?= $form->field($model, 'picture')->widget(FileInput::class, [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'brief_description')->textarea(['rows' => 6]) ?>
        </div>


        <div class="col-md-12 form-group text-center">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
</div>
