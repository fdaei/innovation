<?php


use common\models\Business;
use common\models\BusinessesInvestors;
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
/** @var BusinessMember $$headlines */
/** @var BusinessStat $stat */
/** @var BusinessesInvestors $investors */




$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('Event'); ?>
        <div class="m-4">
            <div class="row">
                <div class="col-10 row">
                    <div class="col-4">
                        <label for="name">title:</label>
                        <p><?= $model->title ?></p>
                    </div>
                    <div class="col-4">
                        <label for="email">title_brief:</label>
                        <p><?= $model->title_brief ?></p>
                    </div>
                    <div class="col-4">
                        <label for="phone"> price:</label>
                        <p><?= $model->price ?></p>
                    </div>
                    <div class="col-4">
                        <label for="address">price_before_discount:</label>
                        <p><?= $model->price_before_discount ?></p>
                    </div>
                    <div class="col-4">
                        <label for="address">evand_link:</label>
                        <p><?= $model->evand_link ?></p>
                    </div>
                    <div class="col-4">
                        <label for="address">address:</label>
                        <p><?= $model->address ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <img  style="height: 300px;width: 300px;" src="<?= $model->getUploadUrl('picture') ?>">
                </div>
                <div class="col-12">
                    <label for="address">description:</label>
                    <p><?= $model->description ?></p>
                </div>
            </div>
        </div>
            <?= Html::a(Yii::t('app', 'update'), ['/event/update','id'=>$model->id], ['class' => 'btn btn-info btn-rounded']) ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('Sponsors'); ?>
        <?php Pjax::begin(['id' => 'p-jax-Event-sponsors', 'enablePushState' => false]); ?>
        <div class=" card">
            <div class="card-header">
                <h3 class="float-left">سرمایه گذاران </h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/event-sponsors/create','id'=>$model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-Event-sponsors',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
            </div>
            <div class="row">

                <?php foreach ($model->eventSponsorsInfo as $i => $item): ?>
                    <div class="col-sm-6 row p-5">
                        <div class="col-9 row">
                            <div class="col-sm-6">
                                <label for="email">title:</label>
                                <p><?= $item->title ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">description:</label>
                                <p><?= $item->description ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">instagram:</label>
                                <p><?= $item->instagram ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">telegram:</label>
                                <p><?= $item->telegram ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">whatsapp:</label>
                                <p><?= $item->whatsapp ?></p>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <img style="width: 100px; height: 100px;" src="<?= $item->getUploadUrl('picture')?>" >
                        </div>
                        <div class="col-12">
                            <div class="card-footer m-0">
                                <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'delete'),
                                        'aria-label' => Yii::t('yii', 'delete'),
                                        'data-reload-pjax-container' => 'p-jax-Event-member',
                                        'data-pjax' => '0',
                                        'data-url' => Url::to(['/event-sponsors/delete','id'=>$item->id, 'model_id'=>$model->id]),
                                        'class' => " p-jax-btn",
                                        'data-title' => Yii::t('yii', 'delete'),
                                        'data-toggle' => 'tooltip',
                                        'data-method' => ''
                                    ]);?>
                                <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                    [
                                        'data-pjax' => '0',
                                        'class' => "btn btn-outline-info float-right ",
                                        'data-size' => 'modal-xl',
                                        'data-title' => Yii::t('app', 'update'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modal-pjax',
                                        'data-url' => Url::to(['/event-sponsors/update','id'=>$item->id, 'model_id'=>$model->id]),
                                        'data-handle-form-submit' => 1,
                                        'data-show-loading' => 0,
                                        'data-reload-pjax-container' => 'p-jax-Event-Statistics',
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
        <?php $this->beginBlock('headlines'); ?>
        <?php Pjax::begin(['id' => 'p-jax-mentor-records', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">سرفصل ها</h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/event/create-headlines','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-mentor-records',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php if($model->headlines): ?>
                        <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-outline-info float-right ",
                                'data-size' => 'modal-xl',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['/event/update-headlines','id'=>$model->id]),
                                'data-handle-form-submit' => 1,
                                'data-show-loading' => 0,
                                'data-reload-pjax-container' => 'p-jax-mentor-records',
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
                <?php if($model->headlines): ?>
                    <?php foreach ($model->headlines as $i => $item): ?>
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
        <?php $this->beginBlock('investors'); ?>
        <?php Pjax::begin(['id' => 'p-jax-Event-investors', 'enablePushState' => false]); ?>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('story'); ?>
        <?php Pjax::begin(['id' => 'p-jax-Event-$headlines', 'enablePushState' => false]); ?>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('gallery'); ?>
        <?php Pjax::begin(['id' => 'p-jax-Event-gallery', 'enablePushState' => false]); ?>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Event'),
                    'content' => $this->blocks['Event'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('app', 'headlines'),
                    'content' => $this->blocks['headlines'],
                ],
//                [
//                    'label' => Yii::t('app', 'Sponsors'),
//                    'content' => $this->blocks['Sponsors'],
//                ],
//
//                [
//                    'label' => Yii::t('app', 'investors'),
//                    'content' => $this->blocks['investors'],
//                ],
//                [
//                    'label' => Yii::t('app', 'story'),
//                    'content' => $this->blocks['story'],
//                ],
//                [
//                    'label' => Yii::t('app', 'gallery'),
//                    'content' => $this->blocks['gallery'],
//                ],

            ]
        ]); ?>
    </div>
</div>
