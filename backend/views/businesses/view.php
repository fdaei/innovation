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
/** @var BusinessMember[] $members */
/** @var BusinessTimeline[] $timeline */
/** @var BusinessStat[] $stat */
/** @var BusinessTimelineItem $timelineitems */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('Business'); ?>
        <div class="card-header my-2 text-right">
            <div>
                <?= Html::a(Yii::t('app', 'update'), ['/businesses/update','id'=>$model->id], ['class' => 'btn btn-primary  ']) ?>
            </div>
        </div>
        <div class="row">
        </div>
        <div class="row">
            <div class="col-10 row">
                <div class="col-3">
                    <label><?= Yii::t('app', 'name')?> :</label>
                    <p><?= $model->name ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'slug')?> :</label>
                    <p> <?= $model->slug ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'telegram')?> :</label>
                    <p><?= $model->telegram ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'website')?> :</label>

                    <p><?= $model->website ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'instagram')?> :</label>

                    <p><?= $model->instagram ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'whatsapp')?> :</label>

                    <p><?= $model->whatsapp ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'business_color')?> :</label>

                    <p><?= $model->business_color ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'business_en_name')?> :</label>

                    <p><?= $model->business_en_name ?></p>
                </div>
            </div>
            <div class="col-2">
                <img class=" p-2 img-fluid "
                     src=<?= $model->getUploadUrl('business_logo') ?>>
            </div>
            <div class="col-12">
                <label><?= Yii::t('app', 'Description Brief')?> :</label>

                <p><?= $model->description_brief ?></p>
            </div>
            <div class="col-12">
                <label><?= Yii::t('app', 'description')?> :</label>

                <p><?= $model->description ?></p>
            </div>
            <div class="col-12">
                <label><?= Yii::t('app', 'investor_description')?> :</label>

                <p><?= $model->investor_description ?></p>
            </div>
            <div class="col-12">
                <label><?= Yii::t('app', 'short_description')?> :</label>

                <p><?= $model->short_description ?></p>
            </div>
            <div class="col-12">
                <label><?= Yii::t('app', 'success_story')?> :</label>

                <p><?= $model->success_story ?></p>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Galleries'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-gallery', 'enablePushState' => false]); ?>
        <div class="d-flex">
            <div class="">
                <div class="card-header">
                    <div class="text-right">
                        <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-primary",
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
            <div class="col-12 card-header">
                <div class="btn-group float-right" role="group">
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-primary",
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
            <div class="col-12 card-header">
                <div class="btn-group mr-2 float-right" role="group" aria-label="First group">
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-primary",
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
                <div class="col-4 card d-inline mt-2">
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
                    <div class="card-header text-right">
                        <?= Html::a(Yii::t('app', 'create Time'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-outline-primary",
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
                                'class' => "btn btn-primary",
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
                    <div class="card-body">
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
                                        <li class="<?= $i === 0 ? 'selected' : '' ?> " data-date="01/01/<?= $item->year ?>">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div>
                                                        <h2 class="">
                                                            <h2><?= $item->year ?></h2>
                                                            <h3><?= $item->convert([$item->year]) ?></h3>
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <?php foreach ($item->timeLineIem as $it): ?>
                                                    <div class="">
                                                        <i class="fa fa-check mr-3"></i>
                                                        <?= $it->description ?>
                                                        <div class="text-right">
                                                            <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => " text-danger"]), 'javascript:void(0)',
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
                                                                ]); ?>/
                                                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                                                [
                                                                    'data-pjax' => '0',
                                                                    'class' => "text-info",
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
                                                        </div>
                                                        </p>
                                                        <?php endforeach; ?>
                                                </div>
                                            </div>
                                                <div class="card-footer">
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
                                                </div>
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
                        'class' => "btn btn-primary float-right ",
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
                                <label for="email"><?=Yii::t('app', 'title')?>:</label>
                                <p><?= $item->title ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="email"><?=Yii::t('app', 'Year')?>:</label>
                                <p><?= $item->year ?></p>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <img style="width: 100px; height: 100px;" src="<?= $item->getUploadUrl('picture') ?>">
                        </div>
                        <div class="col-12">
                            <label for="email"><?=Yii::t('app', 'text')?>:</label>
                            <?php foreach ($item->texts as $ite): ?>
                                <p><?= $ite['title'] ?></p>
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
            </div>
            <div class="row">
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_main_desktop') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_main_desktop']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_main_mobile') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_main_mobile']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_desktop') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_small1_desktop']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_mobile') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_small1_mobile']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_desktop') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_small2_desktop']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_mobile') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'pic_small2_mobile']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">والپیپر</label>
                        <img src="<?= $model->getUploadUrl('wallpaper') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'wallpaper']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">والپیپر موبایل</label>
                        <img src="<?= $model->getUploadUrl('mobile_wallpaper') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'mobile_wallpaper']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">والپیپر تبلت</label>
                        <img src="<?= $model->getUploadUrl('tablet_wallpaper') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'tablet_wallpaper']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">picture_desktop</label>
                        <img src="<?= $model->getUploadUrl('picture_desktop') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'picture_desktop']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class=" card my-3">
                        <label class="card-header">picture_mobile</label>
                        <img src="<?= $model->getUploadUrl('picture_mobile') ?>">
                        <div class="card-footer">
                            <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-info float-right ",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/businesses/picture-update', 'id' => $model->id,'filed'=> 'picture_mobile']),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-other-images',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </div>
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
                            'class' => "btn btn-outline-primary float-right mx-1",
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
                                'class' => "btn btn-primary float-right ",
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
                    <th><?=Yii::t('app', 'title')?></th>
                    <th><?=Yii::t('app', 'description')?></th>
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
//                [
//                    'label' => Yii::t('app', 'stories'),
//                    'content' => $this->blocks['story'],
//                ],
            ]
        ]); ?>
    </div>
</div>