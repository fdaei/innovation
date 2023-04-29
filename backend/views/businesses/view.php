<?php


use common\models\Business;
use common\models\BusinessesStory;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\widgets\grid\GridView;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var Business $model */
/** @var BusinessesStory $story */
/** @var BusinessGallery $gallery */
/** @var BusinessMember $services */
/** @var BusinessStat $stat */



$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('Business'); ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-10 row">
                    <div class="col-3">
                        <label for="name">Name:</label>
                        <p><?= $model->name ?></p>
                    </div>
                    <div class="col-3">
                        <label for="email">website:</label>
                        <p><?= $model->website ?></p>
                    </div>
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
                <div class="col-2">
                    <img src="<?= $model->getUploadUrl('business_logo') ?>">
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
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('Statistics'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-Statistics', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/create-statistics','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-Statistics',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'update'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/update-statistics','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-Statistics',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <h3 class="float-left d-inline">آمارها</h3>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>number</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->statistics): ?>
                <?php foreach ($model->statistics as $i => $item): ?>
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
        <?php $this->beginBlock('services'); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">خدمت ها</h3>
                    <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>description</th>
                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->services): ?>
                <?php foreach ($model->services as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td class="float-right">
                        <button class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-outline-info border-0"><i class="fa fa-pencil"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('investors'); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">سرمایه گذاران </h3>
                    <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>title</th>
                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->investors): ?>
                <?php foreach ($model->investors as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['title'] ?></td>
                    <td class="float-right">
                        <button class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-outline-info border-0"><i class="fa fa-pencil"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('story'); ?>
        <div class="m-3 card">
            <div class="card-header">
                <h3 class="float-left">سرمایه گذاران </h3>
                <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
            </div>
            <div class="row">

                <?php foreach ($story as $i => $item): ?>
                    <div class="col-sm-6 row shadow-sm p-5">
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
                            <img width="120px" height="120px" class="rounded-circle border border-0 border-dark"
                                 src="https://cdn.mobit.ir/get/avinox/business/246/unnamed.png">
                        </div>
                        <div class="col-12">
                            <label for="phone"> text:</label>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="card-footer m-0">
                                <button class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-outline-info border-0"><i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('gallery'); ?>
        <div class="card container">
            <div class="card-header">
                <h3 class="float-left"> گالرس عکس ها </h3>
                <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_main_desktop') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_main_mobile') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_desktop') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_mobile') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_desktop') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_mobile') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Business'),
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('app', 'Statistics'),
                    'content' => $this->blocks['Statistics'],
                ],
                [
                    'label' => Yii::t('app', 'services'),
                    'content' => $this->blocks['services'],
                ],
                [
                    'label' => Yii::t('app', 'investors'),
                    'content' => $this->blocks['investors'],
                ],
                [
                    'label' => Yii::t('app', 'story'),
                    'content' => $this->blocks['story'],
                ],
                [
                    'label' => Yii::t('app', 'gallery'),
                    'content' => $this->blocks['gallery'],
                ],

            ]
        ]); ?>
    </div>
</div>
