<?php

use backend\assets\TimelineAsset;
use common\models\Businesses;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var Businesses $model */
/** @var BusinessGallery[] $gallery */
/** @var BusinessMember $members */
/** @var BusinessTimeline $timeline */
/** @var BusinessStat $stat */
/** @var BusinessTimelineItem $timelineitems */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('Business'); ?>
        <div class="row">
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">عنوان</span>
                    </h5>
                    <div class="text-center">
                        <div class="ml-auto">
                            <p class="p-2"><span class="font-normal"><?= $model->name ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <span class="btn waves-effect waves-light btn-sm btn-info">لوگو</span>
                    <div class="text-center">
                        <div class="ml-auto">
                            <img class=" p-2 img-fluid " style="width: 62px;height: 65px;border-radius: 28%;"
                                 src=<?= $model->getUploadUrl('business_logo') ?>>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">slug</span>
                    </h5>
                    <div class="text-center">
                        <div class="ml-auto">
                            <p class="p-2"><span class="font-normal"><?= $model->slug ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">لینک</span>
                    </h5>
                    <div class="text-center">
                        <div class="ml-auto">
                            <p class="p-2 text-wrap"><span class="font-normal"><?= $model->website ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">توضیحات اعضای سرمایه گذاران</span>
                    </h5>
                    <div class="text-left">
                        <div class="ml-auto">
                            <p class="p-2 ">
                                <span class="font-normal">
                                    <?= $model->investor_description ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">توضیحات کوتاه</span>
                    </h5>
                    <div class="text-left">
                        <div class="ml-auto">
                            <p class="p-2 ">
                                <span class="font-normal">
                                       <?= $model->short_description ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">داستان موفقیت ها </span>
                    </h5>
                    <div class="text-left">
                        <div class="ml-auto">
                            <p class="p-2 ">
                                <span class="font-normal">
                                       <?= $model->success_story ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10 row">
                <div class="col-3">
                    <label for="phone"> telegram:</label>
                    <p><?= $model->telegram ?></p>
                </div>
                <div class="col-3">
                    <label for="address">instagram:</label>
                    <p><?= $model->instagram ?></p>
                </div>
                <div class="col-3">
                    <label for="address">whatsapp:</label>
                    <p><?= $model->whatsapp ?></p>
                </div>
                <div class="col-3">
                    <label for="phone"> business_color:</label>
                    <p><?= $model->business_color ?></p>
                </div>
                <div class="col-3">
                    <label for="address">business_en_name:</label>
                    <p><?= $model->business_en_name ?></p>
                </div>
            </div>
            <div class="col-12">
                <label for="address">Description Brief:</label>
                <p><?= $model->description_brief ?></p>
            </div>
            <div class="col-12">
                <label for="address">description:</label>
                <p><?= $model->description ?></p>
            </div>
        </div>
        <?= Html::a(Yii::t('app', 'update'), ['/businesses/update','id'=>$model->id], ['class' => 'btn btn-info btn-rounded']) ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Galleries'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-gallery', 'enablePushState' => false]); ?>
        <div class="d-flex">
            <div class="">
                <div class="text-right">
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success m-3",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/business-gallery/create', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-gallery',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                </div>
                <div class="row">
                    <?php foreach ($gallery as $i => $item): ?>
                        <div class="material-card  col-6 my-2">
                            <div class="card-header">
                                <div class="row">
                                    <p class="col-6">تصویر پس زمینه (موبایل)</p>
                                    <p class="col-6">تصویر پس زمینه</p>
                                    <img class="card-img-top img-fluid col-6"
                                         src=<?= $item->getUploadUrl('mobile_image') ?>>
                                    <img class="card-img-top img-fluid col-6" src=<?= $item->getUploadUrl('image') ?>>
                                </div>
                            </div>
                            <div class="card-body ">
                                <p class="card-title"><?= $item->title ?></p>
                                <p class="card-text"><?= $item->description ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group  my-1" role="group" aria-label="First group">
                                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                        [
                                            'data-pjax' => '0',
                                            'class' => "btn btn-outline-primary",
                                            'data-size' => 'modal-xl',
                                            'data-title' => Yii::t('app', 'update',),
                                            'data-toggle' => 'modal',
                                            'data-target' => '#modal-pjax',
                                            'data-url' => Url::to(['/business-gallery/update', 'id' => $item->id]),
                                            'data-handle-form-submit' => 1,
                                            'data-show-loading' => 0,
                                            'data-reload-pjax-container' => 'p-jax-business-gallery',
                                            'data-reload-pjax-container-on-show' => 0
                                        ]) ?>
                                    <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                        [
                                            'title' => Yii::t('yii', 'delete'),
                                            'aria-label' => Yii::t('yii', 'delete'),
                                            'data-reload-pjax-container' => 'p-jax-business-gallery',
                                            'data-pjax' => '0',
                                            'data-url' => Url::to(['/business-gallery/delete', 'id' => $item->id]),
                                            'class' => " p-jax-btn",
                                            'data-title' => Yii::t('yii', 'delete'),
                                            'data-toggle' => 'tooltip',
                                            'data-method' => ''
                                        ]); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Members'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-member', 'enablePushState' => false]); ?>
        <div class="row">
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="First group">
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success m-3",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/business-member/create', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-member',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                </div>
            </div>
            <?php foreach ($members as $i => $item): ?>
                <div class="card material-card d-flex text-left m-2 ">
                    <div class="card-img-top">
                        <img src=<?= $item->getUploadUrl('image') ?>>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title"><span><?= $item->first_name ?></span><span><?= $item->last_name ?></span>
                        </h4>
                        <p class="text-muted"><?= $item->position ?></p>
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-primary",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'update',),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/business-member/update', 'id' => $item->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-member',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                            <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                [
                                    'title' => Yii::t('yii', 'delete'),
                                    'aria-label' => Yii::t('yii', 'delete'),
                                    'data-reload-pjax-container' => 'p-jax-business-member',
                                    'data-pjax' => '0',
                                    'data-url' => Url::to(['/business-member/delete', 'id' => $item->id]),
                                    'class' => " p-jax-btn",
                                    'data-title' => Yii::t('yii', 'delete'),
                                    'data-toggle' => 'tooltip',
                                    'data-method' => ''
                                ]); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Stat'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-stat', 'enablePushState' => false]); ?>
        <div class="row">
            <div class="col-12  mt-3">
                <div class="btn-group mr-2 float-right" role="group" aria-label="First group">
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success m-3",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/business-stat/create', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-stat',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                </div>
            </div>
            <?php foreach ($stat as $i => $item): ?>
                <div class="col-4 card d-inline">
                    <div class="row mx-1 border border- border-1 shadow-sm">
                        <div class="col-md-4">
                            <img src="<?= $item->getUploadUrl('icon') ?>" class="card-img pt-3">
                        </div>
                        <div class="col-md-8">
                            <div class="p-2">
                                <h5 class="card-title"> <?= $item->title ?></h5>
                                <p class="card-text"><?= $item->subtitle ?></p>
                                <p class="card-text"><?= $item->type ?></p>
                                <div class="text-right">
                                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                        [
                                            'data-pjax' => '0',
                                            'class' => "btn btn-outline-primary",
                                            'data-size' => 'modal-xl',
                                            'data-title' => Yii::t('app', 'update',),
                                            'data-toggle' => 'modal',
                                            'data-target' => '#modal-pjax',
                                            'data-url' => Url::to(['/business-stat/update', 'id' => $item->id]),
                                            'data-handle-form-submit' => 1,
                                            'data-show-loading' => 0,
                                            'data-reload-pjax-container' => 'p-jax-business-stat',
                                            'data-reload-pjax-container-on-show' => 0
                                        ]) ?>
                                    <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                        [
                                            'title' => Yii::t('yii', 'delete'),
                                            'aria-label' => Yii::t('yii', 'delete'),
                                            'data-reload-pjax-container' => 'p-jax-business-stat',
                                            'data-pjax' => '0',
                                            'data-url' => Url::to(['/business-stat/delete', 'id' => $item->id]),
                                            'class' => " p-jax-btn",
                                            'data-title' => Yii::t('yii', 'delete'),
                                            'data-toggle' => 'tooltip',
                                            'data-method' => ''
                                        ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Timeline'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-timeline', 'enablePushState' => false]); ?>
        <?php TimelineAsset::register($this); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <?= Html::a(Yii::t('app', 'create Time'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-success m-3",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create Time'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/business-timeline/create', 'id' => $model->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-timeline',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                            <?= Html::a(Yii::t('app', 'create create Item'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-success m-3",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create Item'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/business-timeline-item/create']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-timeline',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                        <section class="cd-horizontal-timeline">
                            <div class="timeline">
                                <div class="events-wrapper">
                                    <div class="events">
                                        <ol>
                                            <?php foreach ($timeline as $i => $item): ?>
                                                <li>
                                                    <a href="#0" data-date="01/01/<?= $item->year ?>"
                                                       class="<?= $i == 0 ? 'selected' : '' ?>"><?= $item->year ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                        <span class="filling-line" aria-hidden="true"></span>
                                    </div>

                                    <!-- .events -->
                                </div>
                                <!-- .events-wrapper -->
                                <ul class="cd-timeline-navigation">
                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                    <li><a href="#0" class="next">Next</a></li>
                                </ul>
                                <!-- .cd-timeline-navigation -->
                            </div>
                            <!-- .timeline -->
                            <div class="events-content">
                                <ol>
                                    <?php foreach ($timeline as $i => $item): ?>
                                        <li class="<?= $i === 0 ? 'selected' : '' ?> "
                                            data-date="01/01/<?= $item->year ?>">
                                            <div class="shadow-sm shadow border border- border-1 p-3">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h2 class="my-2">
                                                            <span><?= $item->year ?></span>
                                                            <span><?= $item->convert([$item->year]) ?></span>
                                                        </h2>
                                                    </div>
                                                </div>
                                                <?php foreach ($item->timeLineIem as $it): ?>
                                                    <p class="pt-3">
                                                        <i class="fa fa-check"></i>
                                                        <?= $it->description ?>
                                                        <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                                            [
                                                                'title' => Yii::t('yii', 'delete'),
                                                                'aria-label' => Yii::t('yii', 'delete'),
                                                                'data-reload-pjax-container' => 'p-jax-business-timeline',
                                                                'data-pjax' => '0',
                                                                'data-url' => Url::to(['/business-timeline-item/delete', 'id' => $it->id]),
                                                                'class' => " p-jax-btn",
                                                                'data-title' => Yii::t('yii', 'delete'),
                                                                'data-toggle' => 'tooltip',
                                                                'data-method' => ''
                                                            ]); ?>
                                                        <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                                            [
                                                                'data-pjax' => '0',
                                                                'class' => "btn btn-outline-primary m-3",
                                                                'data-size' => 'modal-xl',
                                                                'data-title' => Yii::t('app', 'create Item'),
                                                                'data-toggle' => 'modal',
                                                                'data-target' => '#modal-pjax',
                                                                'data-url' => Url::to(['/business-timeline-item/update', 'id' => $it->id]),
                                                                'data-handle-form-submit' => 1,
                                                                'data-show-loading' => 0,
                                                                'data-reload-pjax-container' => 'p-jax-business-timeline',
                                                                'data-reload-pjax-container-on-show' => 0
                                                            ]) ?>
                                                    </p>
                                                <?php endforeach; ?>
                                            </div>
                                            <p class="b--gray">
                                                <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                                    [
                                                        'title' => Yii::t('yii', 'delete'),
                                                        'aria-label' => Yii::t('yii', 'delete'),
                                                        'data-reload-pjax-container' => 'p-jax-business-timeline',
                                                        'data-pjax' => '0',
                                                        'data-url' => Url::to(['/business-timeline/delete', 'id' => $item->id]),
                                                        'class' => " p-jax-btn",
                                                        'data-title' => Yii::t('yii', 'delete'),
                                                        'data-toggle' => 'tooltip',
                                                        'data-method' => ''
                                                    ]); ?>
                                                <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                                    [
                                                        'data-pjax' => '0',
                                                        'class' => "btn btn-outline-primary m-3",
                                                        'data-size' => 'modal-xl',
                                                        'data-title' => Yii::t('app', 'create Item'),
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#modal-pjax',
                                                        'data-url' => Url::to(['/business-timeline/update', 'id' => $item->id]),
                                                        'data-handle-form-submit' => 1,
                                                        'data-show-loading' => 0,
                                                        'data-reload-pjax-container' => 'p-jax-business-timeline',
                                                        'data-reload-pjax-container-on-show' => 0
                                                    ]) ?>
                                            </p>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- .events-content -->
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('story'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-stories', 'enablePushState' => false]); ?>
        <div class=" card">
            <div class="card-header">
                <h3 class="float-left">داستان ها</h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/businesses-story/create', 'id' => $model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-business-stories',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
            </div>
            <div class="row">

                <?php foreach ($model->businessesStory as $i => $item): ?>
                    <div class="col-sm-6 row p-5">
                        <div class="col-9 row">
                            <div class="col-sm-6">
                                <label for="email">title:</label>
                                <p><?= $item->title ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">Year:</label>
                                <p><?= $item->year ?></p>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <img style="width: 100px; height: 100px;" src="<?= $item->getUploadUrl('picture') ?>">
                        </div>
                        <div class="col-12">
                            <label> text:</label>
                            <?php foreach ($item->texts as $ite): ?>
                                <p><?= $ite ?></p>
                            <?php endforeach; ?>
                            <div class="card-footer m-0">
                                <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'delete'),
                                        'aria-label' => Yii::t('yii', 'delete'),
                                        'data-reload-pjax-container' => 'p-jax-business-stories',
                                        'data-pjax' => '0',
                                        'data-url' => Url::to(['/businesses-story/delete', 'id' => $item->id, 'model_id' => $model->id]),
                                        'class' => " p-jax-btn",
                                        'data-title' => Yii::t('yii', 'delete'),
                                        'data-toggle' => 'tooltip',
                                        'data-method' => ''
                                    ]); ?>
                                <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                    [
                                        'data-pjax' => '0',
                                        'class' => "btn btn-outline-info float-right ",
                                        'data-size' => 'modal-xl',
                                        'data-title' => Yii::t('app', 'update'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modal-pjax',
                                        'data-url' => Url::to(['/businesses-story/update', 'id' => $item->id, 'model_id' => $model->id]),
                                        'data-handle-form-submit' => 1,
                                        'data-show-loading' => 0,
                                        'data-reload-pjax-container' => 'p-jax-business-stories',
                                        'data-reload-pjax-container-on-show' => 0
                                    ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('other-images'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-other-images', 'enablePushState' => false]); ?>
        <div class="card ">
            <div class="card-header">
                <h3 class="float-left"> سایر تصاویر کسب و کار </h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/businesses/pic-create', 'id' => $model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-business-other-images',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
                <?php if (
                    $model->wallpaper ||
                    $model->mobile_wallpaper ||
                    $model->tablet_wallpaper ||
                    $model->pic_main_desktop ||
                    $model->pic_main_mobile ||
                    $model->pic_small1_desktop ||
                    $model->pic_small1_mobile ||
                    $model->pic_small2_desktop ||
                    $model->pic_small2_mobile): ?>
                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-info float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/pic-update', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-other-images',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_main_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_main_mobile') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_mobile') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_mobile') ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('services'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-services', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">خدمت ها</h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/create-services', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-services',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php if ($model->services): ?>
                        <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-outline-info float-right ",
                                'data-size' => 'modal-xl',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['/businesses/update-services', 'id' => $model->id]),
                                'data-handle-form-submit' => 1,
                                'data-show-loading' => 0,
                                'data-reload-pjax-container' => 'p-jax-business-services',
                                'data-reload-pjax-container-on-show' => 0
                            ]) ?>
                    <?php endif; ?>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>description</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->services): ?>
                    <?php foreach ($model->services as $i => $item): ?>
                        <td><?= $i ?></td>
                        <td><?= $item['title'] ?></td>
                        <td><?= $item['description'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Business'),
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('app', 'Other Images'),
                    'content' => $this->blocks['other-images'],
                ],
                [
                    'label' => Yii::t('app', 'Galleries'),
                    'content' => $this->blocks['Galleries'],
                ],
                [
                    'label' => Yii::t('app', 'Members'),
                    'content' => $this->blocks['Members'],
                ],
                [
                    'label' => Yii::t('app', 'Timeline'),
                    'content' => $this->blocks['Timeline'],
                ],
                [
                    'label' => Yii::t('app', 'Stat'),
                    'content' => $this->blocks['Stat'],
                ],
                [
                    'label' => Yii::t('app', 'services'),
                    'content' => $this->blocks['services'],
                ],
                [
                    'label' => Yii::t('app', 'stories'),
                    'content' => $this->blocks['story'],
                ],
            ]
        ]); ?>
    </div>
</div>