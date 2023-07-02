<?php

use common\models\Tag;
use common\widgets\TagsInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\MaskedInput;


/** @var yii\web\View $this */
/** @var common\models\Event $model */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var common\models\EventTime $EventTimes */
/** @var common\models\Tag $searchedTags */

?>

<div class="event-form">
    <?php $form = ActiveForm::begin(['id' => 'event_form']); ?>
    <div class="card card-body">
        <div class="row justify-content-center">
            <div class='col-md-4 '>
                <?= $form->field($model, 'event_organizer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Event::getOrganizerList(), 'id', 'organizer_name')) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'title_brief')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'evand_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'price')->widget(MaskedInput::class,
                    [
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                        'clientOptions' => [
                            'alias' => 'integer',
                            'groupSeparator' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            'autoUnmask' => true,
                        ],
                    ])->label('قیمت (تومان)') ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'price_before_discount')->widget(MaskedInput::class,
                    [
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                        'clientOptions' => [
                            'alias' => 'integer',
                            'groupSeparator' => ',',
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                            'autoUnmask' => true,
                        ],
                    ])->label('قیمت قبل از تخفیف (تومان)') ?>
            </div>
            <div class='col-md-4 mt-4 '>

                <?= $form->field($model, 'tagNames')->widget(Select2::class, [
                    'options' => ['placeholder' => 'Select tags...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'closeOnSelect' => false,
                        'minimumInputLength' => 2,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'ajax' => [
                            'url' => Url::to(['/tag/list', 'type' => null]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {query:params.term}; }'),
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function (data) { return (data.html != undefined) ? data.text : null; }'),
                        'templateSelection' => new JsExpression('function (data) {
            var selectElement = $(data.element).parent();
            if (selectElement.data("tags")[data.id] != undefined) {
                var type = selectElement.data("tags")[data.id];
                var typeClass = $(".TagInput").data("tags-type")[type];
                var tagHtml = "<span class=\"text-bold badge badge-" + typeClass + "\">" + data.text + "</span>";
                tagHtml = $(tagHtml).addClass("text-dark");
                return tagHtml;
            } else {
                return data.text;
            }
        }'),
                    ],
                ])->label(false); ?>



            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-4 '>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-6 '>
                <?= $form->field($model, "picture")->label(false)->widget(FileInput::class, [
                    'options' => [
                        'multiple' => false,
                        //'accept' => 'image/*',
                    ],
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'showCancel' => false,
                        'theme' => 'explorer-fas',
                        'browseClass' => 'btn btn-primary btn-sm btn-preview',
                        'browseIcon' => '<i class="fas fa-file"></i> ',
                        'browseLabel' => Yii::t('app', 'Choose a file ...'),
                        'previewFileType' => 'image',
                        'initialPreviewAsData' => true,
                        'initialPreview' => (!$model->isNewRecord && $model->getUploadUrl("picture")) ? $model->getUploadUrl("picture") : false,
                        'initialPreviewFileType' => 'image',
                    ]
                ])->hint("Width:1180px,Height:504,Size:2Mb") ?>
            </div>
            <span class='col-md-6'>
                 <p class="card-title border-bottom">
                <div id="map" style="width: 100%;height: 400px;"></div>
                </p>
                <?= $form->field($model, 'longitude')->textInput(['style' => 'display: none'])->label(false) ?>
                <?= $form->field($model, 'latitude')->textInput(['style' => 'display: none'])->label(false) ?>
            </span>
            <div class='col-md-12 kohl' style="">
                <div class="panel-body ">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items-time', // required: css class selector
                        'widgetItem' => '.item-time', // required: css class
                        'limit' => 20, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item_time', // css class
                        'deleteButton' => '.remove-item_time', // css class
                        'model' => $EventTimes[0],
                        'formId' => 'event_form',
                        'formFields' => [
                            'start_at',
                            'end_at'
                        ],
                    ]); ?>
                    <div class="container-items-time card"><!-- widgetContainer -->
                        <div class="card-header">
                            <h3>زمان برگذاری رویداد</h3>
                            <div class="clearfix"></div>
                        </div>
                        <?php foreach ($EventTimes as $i => $time): ?>
                            <div class="item-time panel panel-default"><!-- widgetBody -->
                                <div class="panel-body card-body">
                                    <?php
                                    // necessary for update action.
                                    if (!$time->isNewRecord) {
                                        echo Html::activeHiddenInput($time, "[{$i}]id");
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <button type="button" class="remove-item_time btn btn-danger btn-xs">حذف
                                            </button>
                                        </div>
                                        <!--                                        --><?php //endif;?>
                                        <div class="col-sm-6">
                                            <?= $form->field($time, "[{$i}]start_at")->textInput(['maxlength' => true, 'value' => $time->start_at ? Yii::$app->pdate->tr_num(Yii::$app->pdate->jdate('Y/m/d H:i', $time->start_at)) : "", 'data-jdp' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($time, "[{$i}]end_at")->textInput(['maxlength' => true, 'value' => $time->end_at ? Yii::$app->pdate->tr_num(Yii::$app->pdate->jdate('Y/m/d H:i', $time->end_at)) : "", 'data-jdp' => true]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="add-item_time btn btn-success btn-xs">زمان جدید</button>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb-0 card-footer d-flex ">
        <div class="float-right">
            <div>
                <button type="submit" class="btn btn-info">ثبت</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>
