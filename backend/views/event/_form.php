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
        <div class='col-md-8 kohl'> <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-8 row justify-content-center'>
            <div class='col-md-6 p-0'>
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class='col-md-6 p-0'>
                <?= $form->field($model, 'price_before_discount')->textInput() ?>
            </div>
        </div>
        <div class='col-md-8 kohl'>
            <?= $form->field($model, 'sponsors')->textInput() ?>
        </div>
        <div class='col-md-8 kohl'>
            <?php if ($model->headlines) { ?>
                <div id="number-headlines">
                    <?php foreach ($model->headlines as $value => $i): ?>
                        <div class="AddHeadlines">
                            <label>سرفصل </label>
                            <input type="text" id="event-headlines" class="form-control"
                                   name="Event[headlines][<?= $value ?>]['title']" maxlength="255" aria-required="true"
                                   aria-invalid="true" value="<?= $i["'title'"] ?>">
                            <label>محتوای هر سر فصل </label>
                            <input type="text" id="event-headlines" class="form-control"
                                   name="Event[headlines][<?= $value ?>]['description']" maxlength="255"
                                   aria-required="true"
                                   aria-invalid="true" value="<?= $i["'description'"] ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a id="AddHeadlines" class=" btn btn-success btn-sm">+</a>
                <a id="RemoveHeadlines" class=" btn btn-danger btn-sm">-</a>
            <?php } else { ?>
                <div id="number-headlines">
                    <div class="AddHeadlines">
                        <label>سرفصل </label>
                        <input type="text" id="event-headlines" class="form-control" name="Event[headlines][0]['title']"
                               maxlength="255" aria-required="true" aria-invalid="true">
                        <label>محتوای هر سر فصل </label>
                        <input type="text" id="event-headlines" class="form-control"
                               name="Event[headlines][0]['description']" maxlength="255" aria-required="true"
                               aria-invalid="true">
                    </div>
                </div>
                <a id="AddHeadlines" class=" btn btn-success btn-sm">+</a>
                <a id="RemoveHeadlines" class=" btn btn-danger btn-sm">-</a>
            <?php } ?>
        </div>

        <div class='col-md-8 kohl'>
            <div>
                <label>زمان های رویداد</label>
                <?php if ($model->event_times) { ?>
                    <div id="number-datepicker">
                        <?php foreach ($model->event_times as $value => $i): ?>
                            <input type="text" id="event-event_times" class="someInput form-control my-2"
                                   name="Event[event_times][<?= $value ?>]" maxlength="255" aria-required="true"
                                   aria-invalid="true" data-jdp value="<?= $i ?>">
                        <?php endforeach; ?>
                    </div>
                    <a id="AddDatepicker" class=" btn btn-success btn-sm">+</a>
                    <a id="RemoveDatepicker" class=" btn btn-danger btn-sm">-</a>

                <?php } else { ?>
                    <div id="number-datepicker">
                        <input type="text" id="event-event_times" class="form-control" name="Event[event_times][0]"
                               maxlength="255" aria-required="true" aria-invalid="true" data-jdp>
                    </div>
                    <a id="AddDatepicker" class=" btn btn-success btn-sm">+</a>
                    <a id="RemoveDatepicker" class=" btn btn-danger btn-sm">-</a>
                <?php } ?>
            </div>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6 kohl'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <span class='col-md-12'>
                 <p class="card-title border-bottom m-2 pb-3">
                <div id="map" style="width: 100%;height: 400px;"></div>
            </p>
            <?= $form->field($model, 'longitude')->textInput(['style' => 'display: none'])->label(false) ?>
            <?= $form->field($model, 'latitude')->textInput(['style' => 'display: none'])->label(false) ?>
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
        time: true,
    })
</script>

