<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventHallReserved $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="event-hall-reserved-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'>
            <label>زمان شروع</label>
            <input type="text" id="event-timestamp_start" class="form-control" name="EventHallReserved[timestamp_start]"
                   maxlength="255" aria-required="true" aria-invalid="true" data-jdp>
        </div>
        <div class='col-md-8'>
            <label>زمان پایان</label>
            <input type="text" id="event-timestamp_end" class="form-control" name="EventHallReserved[timestamp_end]"
                   maxlength="255" aria-required="true" aria-invalid="true" data-jdp>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
            zIndex:2000,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>