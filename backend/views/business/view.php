<?php

use common\models\Business;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

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
    <div class="card-body">
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
                        <div class="ml-auto"  >
                            <img class=" p-2 img-fluid " src=<?= $model->getUploadUrl('logo') ?>>
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

        <div id="carouselExampleIndicators3" class="carousel slide pb-3" data-ride="carousel"
             style="border:1px solid lightgray ;">
            <div class="carousel-inner" role="listbox">
                <div class="text-right">
                    <?= Html::a(Yii::t('app', 'create').'<i class="fa fa-check"></i>', ['/business-gallery/create'], ['class' => 'btn btn-outline-success btn-sm mt-3 mr-5  rounded-3 ', "method" => "post"]) ?>
                    <?php echo Html::a('<span class="glyphicon glyphicon-comment">ooooooooooooooooooooooooooooooo</span>',
                        ['/business/my-comment'],
                        [
                                'value'=>'/business/my-comment',
                            'title' => 'View Feed Comments',
                            'data-toggle'=>'modal',
                            'data-target'=>'#modalvote',
                        ]
                    );
                    ?>
                </div>
                <div class="modal remote fade" id="modalvote">
                    <div class="modal-dialog">
                        <div class="modal-content loader-lg"></div>
                    </div>
                </div>
                <?php foreach ($gallery as $i => $item): ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                        <div class="row" style="border-bottom:2px solid #8b8b8b80">
                            <div class="col-4">
                                <h5 class="alert alert-info rounded-3">
                                    <p>تصویر پس زمینه (موبایل)</p>
                                </h5>
                                <img class="img-fluid" src=<?= $item->getUploadUrl('mobile_image') ?> alt="First slide">
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-10">
                                        <h5 class="alert alert-info rounded-3">
                                            <p>تصویر پس زمینه </p>
                                        </h5>
                                    </div>
                                    <div class="col-2 m-0">
                                        <div class="btn-group  my-1" role="group" aria-label="First group">
                                            <?= Html::a(Yii::t('app', 'update').'<i class="fa fa-pen"></i>', ['/business-gallery/update', 'id' => $item->id], ['class' => 'btn btn-outline-warning btn-sm rounded-3', "method" => "post"]) ?>
                                        </div>
                                        <div>
                                            <?= Html::a(Yii::t('app', 'delete').'<i class="fa fa-trash"></i>', ['/business-gallery/delete', 'id' => $item->id], ['class' => 'btn btn-outline-danger btn-sm rounded-3', "data-method" => "post"]) ?>
                                        </div>
                                    </div>
                                </div>
                                <img class="img-fluid" src=<?= $item->getUploadUrl('image') ?> alt="First slide">
                            </div>
                        </div>
                        <div class="row d-none d-md-block p-4 alert alert-info">
                            <h2 class="pb-2"><?= $item->title ?></h2>
                            <p><?= $item->description ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <ol class="carousel-indicators">
                <?php foreach ($gallery as $i => $item): ?>
                    <li data-target="#carouselExampleIndicators3"
                        data-slide-to=<?= $i ?> class="<?= $i == 0 ? 'active' : '' ?>"></li>
                <?php endforeach; ?>
            </ol>
        </div>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Members'); ?>
        <div class="row">
            <div class="col-12  mt-3">
                <p class="float-left alert alert-info">اعضا و سرمایه گذاران</p>
                <div class="btn-group mr-2 float-right" role="group" aria-label="First group">
                    <?= Html::a(Yii::t('app', 'create').'<i class="fa fa-check"></i>', ['/business-member/create'], ['class' => 'btn btn-outline-success btn-sm rounded-3', "method" => "post"]) ?>
                </div>
            </div>
            <?php foreach ($members as $i => $item): ?>
                <div class="el-card-avatar el-overlay-1 col-3 mt-3 text-center">
                    <img class="card-img-top img-responsive" src=<?= $item->getUploadUrl('image') ?> alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><span><?= $item->first_name ?></span><span><?= $item->last_name ?></span>
                        </h4>
                        <p class="text-muted"><?= $item->position ?></p>
                        <?= Html::a(Yii::t('app', 'delete').'<i class="fa fa-trash"></i>', ['/business-member/delete', 'id' => $item->id], ['class' => 'btn btn-outline-danger btn-sm ', "data-method" => "post"]) ?>
                        <?= Html::a(Yii::t('app', 'update').'<i class="fa fa-pen"></i>', ['/business-member/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-sm ', "method" => "post"]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Stat'); ?>
        <div class="row">
            <div class="col-12  mt-3">
                <p class="float-left alert alert-info">آمار و احتمالات</p>
                <div class="btn-group mr-2 float-right" role="group" aria-label="First group">
                    <?= Html::a(Yii::t('app', 'create').'<i class="fa fa-check"></i>', ['/business-stat/create'], ['class' => 'btn btn-outline-success btn-sm rounded-3', "method" => "post"]) ?>

                </div>
            </div>
            <?php foreach ($stat as $i => $item): ?>
                <div class="col-4 card d-inline" >
                    <div class="row mx-1 border border- border-1 shadow-sm">
                        <div class="col-md-4">
                            <img src="<?= $item->getUploadUrl('icon') ?>" class="card-img pt-3" >
                        </div>
                        <div class="col-md-8">
                            <div class="p-2">
                                <h5 class="card-title"> <?= $item->title ?></h5>
                                <p class="card-text"><?= $item->subtitle ?></p>
                                <p class="card-text"><?= $item->type ?></p>
                                <div class="text-right">
                                    <?= Html::a(Yii::t('app', 'delete').'<i class="fa fa-trash"></i>', ['/business-stat/delete', 'id' => $item->id], ['class' => 'btn btn-outline-danger btn-sm ', "data-method" => "post"]) ?>
                                    <?= Html::a(Yii::t('app', 'update').'<i class="fa fa-pen"></i>', ['/business-stat/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-sm ', "method" => "post"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Timeline'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <?= Html::a(Yii::t('app', 'create Item'), ['/business-timeline-item/create'], ['class' => 'btn btn-outline-success btn-sm float-right m-1', "method" => "post"]) ?>
                            <?= Html::a(Yii::t('app', 'create Time'), ['/business-timeline/create'], ['class' => 'btn btn-outline-success btn-sm float-right m-1', "method" => "post"]) ?>
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
                                        <li class="<?= $i === 0 ? 'selected' : '' ?> " data-date="01/01/<?= $item->year ?>">
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
                                                    <?= Html::a('<i class="fas fa-trash"></i>', ['/business-timeline-item/delete', 'id' => $it->id], ['class' => ' btn  btn btn-outline-secondary btn-sm float-right m-1', "data-method" => "post"]) ?>
                                                    <?= Html::a('<i class="fas fa-pen"></i>', ['/business-timeline-item/update', 'id' => $it->id], ['class' => 'btn btn-outline-secondary btn-sm float-right m-1', "method" => "post"]) ?>
                                                </p>
                                            <?php endforeach; ?>
                                            </div>
                                            <p class="b--gray">
                                                <?= Html::a(Yii::t('app', 'delete').'<i class="fas fa-trash"></i>', ['/business-timeline/delete', 'id' => $item->id], ['class' => 'btn  btn btn-outline-info btn-sm  mt-5', "data-method" => "post"]) ?>
                                                <?= Html::a(Yii::t('app', 'update').'<i class="fas fa-pen"></i>', ['/business-timeline/update', 'id' => $item->id], ['class' => 'btn  btn btn-outline-info btn-sm  mt-5', "method" => "post"]) ?>
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
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => 'Business',
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => 'Galleries',
                    'content' => $this->blocks['Galleries'],
                ],
                [
                    'label' => 'Members',
                    'content' => $this->blocks['Members'],
                ],
                [
                    'label' => 'Timeline',
                    'content' => $this->blocks['Timeline'],
                ],
                [
                    'label' => 'Stat',
                    'content' => $this->blocks['Stat'],
                ],
            ]
        ]); ?>
    </div>
</div>
<!--e-->