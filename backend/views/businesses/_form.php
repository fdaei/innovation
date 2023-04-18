<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="businesses-form">

    <?php $form = ActiveForm::begin([
        'id' => 'businesses_form'
    ]); ?>
    <div class="row bg-white p-3">
        <div class="col-md-12 ">
            <h1 class="bg-white mx-0 m-0"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row bg-white p-3 rounded">
        <div class="col-md-4 ">
            <?= $form->field($model, 'name')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'business_en_name')->textInput(['class' => 'custom_input_search d-inline', 'business_color' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'business_color')->textInput(['class' => 'custom_input_search d-inline', 'business_color' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'description_brief')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'website')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'telegram')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'instagram')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'whatsapp')->textInput(['class' => 'custom_input_search d-inline', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'description')->textarea(['class' => 'custom_input_search d-inline', 'rows' => 6]) ?>
        </div>
    </div>
    <div class="row bg-white p-3 rounded my-3">
        <div class="card card-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-statistics', // required: css class selector
                'widgetItem' => '.item-statistics', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-statistics', // css class
                'deleteButton' => '.remove-item-statistics', // css class
                'model' => $businessesStatistics[0],
                'formId' => 'businesses_form',
                'formFields' => [
                    'title',
                    'description'
                ],
            ]); ?>
            <div class="container-items-statistics"><!-- widgetContainer -->
                <?php foreach ($businessesStatistics as $i => $modelAddress): ?>
                    <div class="item-statistics panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
                                <button type="button" class="remove-item-statistics btn btn-danger btn-xs">حذف</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="add-item-statistics btn btn-success btn-xs">آمار جدید</button>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>
<div class="card card-body">
    <?= $form->field($model, 'business_logo')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'picture_desktop')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'picture_mobile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_main_desktop')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_main_mobile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_small1_desktop')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_small1_mobile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_small2_desktop')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <?= $form->field($model, 'pic_small2_mobile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
</div>

<div class="card card-body">
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items-services', // required: css class selector
        'widgetItem' => '.item-services', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item-services', // css class
        'deleteButton' => '.remove-item-services', // css class
        'model' => $businessesServices[0],
        'formId' => 'businesses_form',
        'formFields' => [
            'title',
            'description'
        ],
    ]); ?>
    <div class="container-items-services"><!-- widgetContainer -->
        <?php foreach ($businessesServices as $i => $modelAddress): ?>
            <div class="item-services panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                <div class="panel-heading">
                    <div class="pull-right">
                        <button type="button" class="remove-item-services btn btn-danger btn-xs">حذف</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelAddress->isNewRecord) {
                        echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                        </div>
                    </div><!-- .row -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="add-item-services btn btn-success btn-xs">خدمت جدید</button>
    <?php DynamicFormWidget::end(); ?>
</div>

<div class="card card-body">
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper3', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items-sponsors', // required: css class selector
        'widgetItem' => '.item-sponsors', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item-sponsors', // css class
        'deleteButton' => '.remove-item-sponsors', // css class
        'model' => $businessesSponsors[0],
        'formId' => 'businesses_form',
        'formFields' => [
            'title',
            'description'
        ],
    ]); ?>
    <div class="container-items-sponsors"><!-- widgetContainer -->
        <?php foreach ($businessesSponsors as $i => $modelAddress): ?>
            <div class="item-sponsors panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                <div class="panel-heading">
                    <div class="pull-right">
                        <button type="button" class="remove-item-sponsors btn btn-danger btn-xs">حذف</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelAddress->isNewRecord) {
                        echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                        </div>
                    </div><!-- .row -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="add-item-sponsors btn btn-success btn-xs">اسپانسر جدید</button>
    <?php DynamicFormWidget::end(); ?>
</div>

<div class="card card-body">
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper4', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items-story', // required: css class selector
        'widgetItem' => '.item-story', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item-story', // css class
        'deleteButton' => '.remove-item-story', // css class
        'model' => $businessesStory[0],
        'formId' => 'businesses_form',
        'formFields' => [
            'title',
            'description'
        ],
    ]); ?>
    <div class="container-items-story"><!-- widgetContainer -->
        <?php foreach ($businessesStory as $i => $modelAddress): ?>
            <div class="item-story panel panel-default col-md-8" style="padding-right: 0px"><!-- widgetBody -->
                <div class="panel-heading">
                    <div class="pull-right">
                        <button type="button" class="remove-item-story btn btn-danger btn-xs">حذف</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelAddress->isNewRecord) {
                        echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]picture")->fileInput() ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]year")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]title")->textarea(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelAddress, "[{$i}]texts")->textarea(['maxlength' => true]) ?>
                        </div>

                    </div><!-- .row -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="add-item-story btn btn-success btn-xs">داستان جدید</button>
    <?php DynamicFormWidget::end(); ?>
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
