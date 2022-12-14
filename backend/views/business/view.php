<?php

use common\models\Business;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var Business $model */
/** @var BusinessGallery $gallery */
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
        <div class="row ">
            <div class="col-10">
                <h5 class="alert alert-info rounded-3 mt-3">
                    <p>تصویر پس زمینه </p>
                </h5>
                <img class="img-fluid cover" src=<?= $model->getUploadUrl('wallpaper') ?>>
            </div>
            <div class="col-2">
                <h5 class="alert alert-info rounded-3 mt-3">
                    <p>تصویرپس زمینه (موبایل)</p>
                </h5>
                <img class="img-fluid" src=<?= $model->getUploadUrl('mobile_wallpaper') ?>>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">عنوان</span>
                    </h5>
                    <div class="text-center">
                        <div class="ml-auto">
                            <p class="p-2"><span class="font-normal"><?= $model->title ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span class="btn waves-effect waves-light btn-sm btn-info">کاربر</span>
                    </h5>
                    <div class="text-center ">
                        <div class="ml-auto">
                            <p class="p-2"><span class="font-normal"><?= $model->user->username ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="pl-2 m-2 shadow-sm border border- border-1">
                    <h5 class="card-title text-uppercase"><span
                                class="btn waves-effect waves-light btn-sm btn-info">شهر </span></h5>
                    <div class="text-center ">
                        <div class="ml-auto">
                            <p class="p-2 "><span class="font-normal"><?= $model->city->name ?></span></p>
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
                                 src=<?= $model->getUploadUrl('logo') ?>>
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
                            <p class="p-2 text-wrap"><span class="font-normal"><?= $model->link ?></span></p>
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
                            'data-url' => Url::to(['/business-gallery/create','id'=>$model->id]),
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
                                    <img class="card-img-top img-fluid col-6" src=<?= $item->getUploadUrl('mobile_image') ?>>
                                    <img class="card-img-top img-fluid col-6"  src=<?= $item->getUploadUrl('image') ?> >
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
                                            'data-url' => Url::to(['/business-gallery/update','id' => $item->id]),
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
                                            'data-url' => Url::to(['/business-gallery/delete','id' => $item->id]),
                                            'class' => " p-jax-btn",
                                            'data-title' => Yii::t('yii', 'delete'),
                                            'data-toggle' => 'tooltip',
                                            'data-method' => ''
                                        ]);?>
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
                            'data-url' => Url::to(['/business-member/create','id'=>$model->id]),
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
                                    'data-url' => Url::to(['/business-member/update','id' => $item->id]),
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
                                    'data-url' => Url::to(['/business-member/delete','id' => $item->id]),
                                    'class' => " p-jax-btn",
                                    'data-title' => Yii::t('yii', 'delete'),
                                    'data-toggle' => 'tooltip',
                                    'data-method' => ''
                                ]);?>
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
                            'data-url' => Url::to(['/business-stat/create','id'=>$model->id]),
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
                                            'data-url' => Url::to(['/business-stat/update','id' => $item->id]),
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
                                            'data-url' => Url::to(['/business-stat/delete','id' => $item->id]),
                                            'class' => " p-jax-btn",
                                            'data-title' => Yii::t('yii', 'delete'),
                                            'data-toggle' => 'tooltip',
                                            'data-method' => ''
                                        ]);?>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn btn-outline-success m-3",
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'create Time'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/business-timeline/create','id'=>$model->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-timeline',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                            <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
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
                                                                'data-url' => Url::to(['/business-timeline-item/delete','id' => $it->id]),
                                                                'class' => " p-jax-btn",
                                                                'data-title' => Yii::t('yii', 'delete'),
                                                                'data-toggle' => 'tooltip',
                                                                'data-method' => ''
                                                            ]);?>
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
                                                        'data-url' => Url::to(['/business-timeline/delete','id' => $item->id]),
                                                        'class' => " p-jax-btn",
                                                        'data-title' => Yii::t('yii', 'delete'),
                                                        'data-toggle' => 'tooltip',
                                                        'data-method' => ''
                                                    ]);?>
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

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app','Business'),
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('app','Galleries'),
                    'content' => $this->blocks['Galleries'],
                ],
                [
                    'label' => Yii::t('app','Members'),
                    'content' => $this->blocks['Members'],
                ],
                [
                    'label' => Yii::t('app','Timeline'),
                    'content' => $this->blocks['Timeline'],
                ],
                [
                    'label' =>Yii::t('app','Stat'),
                    'content' => $this->blocks['Stat'],
                ],
            ]
        ]); ?>
    </div>
</div>