<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;
use common\models\Freelancer;
use common\models\Province;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\FreelancerCategoryList;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var backend\models\FreelancerSkills $freelancerSkills */
/** @var backend\models\FreelancerRecordJob $freelancerRecordJob */
/** @var backend\models\FreelancerRecordEducational $freelancerRecordEducational */
/** @var backend\models\FreelancerPortfolio $freelancerPortfolio */

?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(['id' => 'freelancer_form']); ?>

    <div class="card border">
        <div class="card-header">
            تصاویر
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'freelancer_picture')->widget(FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'showUpload' => false
                        ]
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'header_picture_mobile')->widget(FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'showUpload' => false
                        ]
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'header_picture_desktop')->widget(FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'showUpload' => false
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card border">
        <div class="card-header">
            اطلاعات فردی
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'user_id')->widget(Select2::class, [
                        'size' => Select2::MEDIUM,
                        'options' => ['placeholder' => Yii::t('app', 'Select User')],
                        'data' => [$model?->user_id => User::findOne($model->user_id)?->fullName()],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 3,
                            'ajax' => [
                                'url' => Url::to(['/freelancer/get-users']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) {return {q:params.term}; }')
                            ],
                        ],
                    ])->label(Yii::t('app','User'));
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'text-right form-control']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,'class'=>'text-right form-control']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'sex')->dropDownList(Freelancer::itemAlias('Sex')) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'military_service_status')->dropDownList(Freelancer::itemAlias('Military')) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'marital_status')->dropDownList(Freelancer::itemAlias('Marital')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'province')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                        'size' => Select2::MEDIUM,
                        'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                    $form->field($model, 'city')->widget(DepDrop::class, [
                        'options' => ['id' => 'freelancer-city'],
                        'data' => [$model->getCity()?->id => $model->getCity()?->name],
                        'pluginOptions' => [
                            'depends' => ['freelancer-province'],
                            'placeholder' => Yii::t('app', 'Select...'),
                            'url' => Url::to(['/province/get-cities'])
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'freelancer_description')->textarea(['rows' => 3]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'description_user')->textarea(['rows' => 3]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card border">
        <div class="card-header">
            اطلاعات کاری
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'experience')->dropDownList(Freelancer::itemAlias('Experience')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'status')->dropDownList(Freelancer::itemAlias('Status')) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'experience_period')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'project_number')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'resume_file')->widget(FileInput::class, [
                        'options' => ['accept' => 'application/pdf,image/*'],
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]) ?>
                </div>
                <div class="col-md-1 text-danger mt-4">
                    <?= $form->field($model, 'accept_rules')->checkbox() ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'categories_list')
                        ->label(Yii::t('app', 'Freelancer Category Lists'))
                        ->widget(Select2::class, [
                            'data' => ArrayHelper::map(FreelancerCategoryList::find()->all(), 'id', 'title'),
                            'options' => ['placeholder' => 'Select a state ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true
                            ],
                        ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card border">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper2',
                    'widgetBody' => '.container-items-skill',
                    'widgetItem' => '.item-skill',
                    'limit' => 20,
                    'min' => $freelancerSkills[0]->isNewRecord ? 0 : 1,
                    'insertButton' => '.add-item-skill',
                    'deleteButton' => '.remove-item-skill',
                    'model' => $freelancerSkills[0],
                    'formId' => 'freelancer_form',
                    'formFields' => [
                        'title',
                    ],
                ]); ?>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <?= Yii::t('app', 'Skills') ?>
                    <button type="button" class="add-item-skill btn btn-success p-1">
                        <span class="fa fa-plus"></span>
                        افزودن
                    </button>
                </div>
                <div class="card-body">
                    <div class="container-items-skill">
                        <?php foreach ($freelancerSkills as $i => $skill): ?>
                            <div class="item-skill panel panel-default">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <?= $form->field($skill, "[{$i}]title")
                                            ->label(false)
                                            ->textInput() ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="remove-item-skill btn btn-danger btn-xs">
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper3',
                    'widgetBody' => '.container-items-recordJob',
                    'widgetItem' => '.item-recordJob',
                    'limit' => 20,
                    'min' => $freelancerRecordJob[0]->isNewRecord ? 0 : 1,
                    'insertButton' => '.add-item-recordJob',
                    'deleteButton' => '.remove-item-recordJob',
                    'model' => $freelancerRecordJob[0],
                    'formId' => 'freelancer_form',
                    'formFields' => [
                        'title',
                    ],
                ]); ?>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <?= Yii::t('app', 'Record Job') ?>
                    <button type="button" class="add-item-recordJob btn btn-success p-1">
                        <span class="fa fa-plus"></span>
                        افزودن
                    </button>
                </div>
                <div class="card-body">
                    <div class="container-items-recordJob">
                        <?php foreach ($freelancerRecordJob as $i => $item): ?>
                            <div class="item-recordJob panel panel-default">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <?= $form->field($item, "[{$i}]title")
                                            ->label(false)
                                            ->textInput() ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button"
                                                class="remove-item-recordJob btn btn-danger btn-xs">
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper4',
                    'widgetBody' => '.container-items-recordEducational',
                    'widgetItem' => '.item-recordEducational',
                    'limit' => 20,
                    'min' => $freelancerRecordEducational[0]->isNewRecord ? 0 : 1,
                    'insertButton' => '.add-item-recordEducational',
                    'deleteButton' => '.remove-item-recordEducational',
                    'model' => $freelancerRecordEducational[0],
                    'formId' => 'freelancer_form',
                    'formFields' => [
                        'title',
                    ],
                ]); ?>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <?= Yii::t('app', 'Record Educational') ?>
                    <button type="button" class="add-item-recordEducational btn btn-success p-1">
                        <span class="fa fa-plus"></span>
                        افزودن
                    </button>
                </div>
                <div class="card-body">
                    <div class="container-items-recordEducational">
                        <?php foreach ($freelancerRecordEducational as $i => $itemEducational): ?>
                            <div class="item-recordEducational panel panel-default" style="padding-right: 0px">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <?= $form->field($itemEducational, "[{$i}]title")
                                                ->label(false)
                                                ->textInput() ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button"
                                                    class="remove-item-recordEducational btn btn-danger btn-xs">
                                                حذف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card border">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper5',
                    'widgetBody' => '.container-items-portfolio',
                    'widgetItem' => '.item-portfolio',
                    'limit' => 20,
                    'min' => $freelancerPortfolio[0]->isNewRecord ? 0 : 1,
                    'insertButton' => '.add-item-portfolio',
                    'deleteButton' => '.remove-item-portfolio',
                    'model' => $freelancerPortfolio[0],
                    'formId' => 'freelancer_form',
                    'formFields' => [
                        'title',
                        'description',
                        'link',
                        'image',
                    ],
                ]); ?>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <?= Yii::t('app', 'Portfolio') ?>
                    <button type="button" class="add-item-portfolio btn btn-success p-1">
                        <span class="fa fa-plus"></span>
                        افزودن
                    </button>
                </div>
                <div class="card-body">
                    <div class="container-items-portfolio">
                        <?php foreach ($freelancerPortfolio as $i => $portfolio): ?>
                            <div class="item-portfolio panel panel-default" style="padding-right: 0px">
                                <div class="panel-body">
                                    <div class="row">
                                        <?php
                                        if (!$portfolio->isNewRecord) {
                                            echo Html::activeHiddenInput($portfolio, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="col-sm-3">
                                            <?= $form->field($portfolio, "[{$i}]title")->textInput() ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($portfolio, "[{$i}]description")->textInput() ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($portfolio, "[{$i}]link")->textInput() ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= $form->field($portfolio, "[{$i}]image")->widget(FileInput::class, [
                                                'options' => ['accept' => 'image/*'],
                                                'pluginOptions' => [
                                                    'showPreview' => false,
                                                    'showCaption' => true,
                                                    'showRemove' => true,
                                                    'showUpload' => false
                                                ]
                                            ]) ?>
                                        </div>
                                        <div class="col-sm-1 pt-4">
                                            <button type="button"
                                                    class="remove-item-portfolio btn btn-danger btn-xs mt-1">
                                                حذف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
