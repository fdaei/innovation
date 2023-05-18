<?php

use common\models\Branches;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BranchesSpecification $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="branches-specification-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">

        <div class='col-md-8'>
            <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
