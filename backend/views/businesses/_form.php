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
                <div class="row">
                    <div class="col-sm-11">
                        <h3>اضافه کردن آمار جدید</h3>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="float-right add-item-statistics btn custom_background_color btn-xs text-white rounded-pill">آمار جدید</button>
                    </div>
                </div>
                <?php foreach ($businessesStatistics as $i => $modelAddress): ?>
                    <div class="item-statistics panel panel-default " ><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                            }
                            ?>
                            <div class="row my-4">
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['class' => 'custom_input_search d-inline','maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]description")->textarea(['class' => 'custom_input_search d-inline','rows' => 6,'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="float-right remove-item-statistics btn custom_background_color2 btn-xs text-white rounded-pill ">حذف</button>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row bg-white p-3 rounded my-3">
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
                <div class="row">
                    <div class="col-sm-11">
                        <h3>اضافه کردن خدمت جدید</h3>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="add-item-services btn btn-success btn-xs custom_background_color rounded-pill">خدمت جدید</button>
                    </div>
                </div>
                <?php foreach ($businessesServices as $i => $modelAddress): ?>
                    <div class="item-services panel panel-default " style="padding-right: 0px"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
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
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['class' => 'custom_input_search d-inline','maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]description")->textarea(['class' => 'custom_input_search d-inline','rows' => 6,'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="float-right remove-item-services btn text-white btn-xs custom_background_color2 rounded-pill">حذف</button>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row bg-white p-3 rounded my-3">

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
                <div class="row">
                    <div class="col-sm-11">
                        <h3>اضافه کردن اسپانسر جدید</h3>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="add-item-sponsors btn btn-success btn-xs custom_background_color rounded-pill">اسپانسر جدید</button>
                    </div>
                </div>
                <?php foreach ($businessesSponsors as $i => $modelAddress): ?>
                    <div class="item-sponsors panel panel-default c"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
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
                                    <?= $form->field($modelAddress, "[{$i}]title")->textInput(['class' => 'custom_input_search d-inline','maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]description")->textarea(['class' => 'custom_input_search d-inline','rows' => 6,'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="remove-item-sponsors btn btn-xs custom_background_color2 rounded-pill text-white float-right">حذف</button>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row bg-white p-3 rounded my-3">
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
                <div class="row">
                    <div class="col-sm-11">
                        <h3>اضافه کردن اسپانسر جدید</h3>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="add-item-story btn btn-success btn-xs custom_background_color rounded-pill">اسپانسر جدید</button>
                    </div>
                </div>
                <?php foreach ($businessesStory as $i => $modelAddress): ?>
                    <div class="item-story panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">

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
                                    <?= $form->field($modelAddress, "[{$i}]year")->textInput(['class' => 'custom_input_search d-inline','maxlength' => true]) ?>
                                    <?= $form->field($modelAddress, "[{$i}]title")->textarea(['class' => 'custom_input_search d-inline','rows' => 6,'maxlength' => true]) ?>
                                    <?= $form->field($modelAddress, "[{$i}]texts")->textarea(['class' => 'custom_input_search d-inline','rows' => 6,'maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAddress, "[{$i}]picture")->widget(FileInput::class, [
                                        'options' => ['accept' => 'image/*'],
                                    ]) ?>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="remove-item-story btn btn-xs custom_background_color2 rounded-pill text-white float-right">حذف</button>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
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
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => ' btn btn-success btn-lg px-5 custom_background_color rounded-pill']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
</div>
