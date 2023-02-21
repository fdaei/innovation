<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Event $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="event-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-6 kohl'> <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'price_before_discount')->textInput() ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'headlines')->textInput() ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'sponsors')->textInput() ?>
        </div>
        <div class='col-md-6 kohl'>
            <div>
                <div  id="firoozeh">
                    <input class="col-sm-12 form-control" data-jdp>
                </div>
                <button id="AddDatepicker" class=" btn btn-success">+</button>
                <button id="RemoveDatepicker" class=" btn btn-danger">-</button>
            </div>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <span class='col-md-12'>
                 <p  class="card-title border-bottom m-2 pb-3">
                <div id="map" style="width: 100%;height: 400px;"></div>
            </p>
            <?= $form->field($model, 'longitude')->textInput(['style'=>'display: none'])->label(false) ?>
            <?= $form->field($model, 'latitude')->textInput(['style'=>'display: none'])->label(false) ?>
        </span>

    </div>
    <div class="form-group mb-0 card-footer d-flex ">
        <div class="float-right">
            <div>
                <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    jalaliDatepicker.startWatch({
        time:true,
    })
</script>

