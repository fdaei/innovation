<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FreelancerCategories $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="freelancer-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row justify-content-center">
        <div class='col-md-8'>
            <?= $form->field($model, 'freelancer_id')->dropDownList(['1' => '1']) ?>
        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'categories_id')->dropDownList(['1' => '1']) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
