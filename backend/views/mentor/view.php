<?php

use common\models\Statuses;
use voime\GoogleMaps\Map;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('mentor'); ?>
        <div class="card">
            <div class="card-header my-3">
                <h3 class="float-left "> گالرس عکس ها </h3>
            </div>
            <div class="card-body row">
                <div class="col-12 row">
                    <div class="col-3">
                        <label for="name">Name:</label>
                        <p><?= $model->name ?></p>
                    </div>
                    <div class="col-3">
                        <label for="email">activity_field:</label>
                        <p><?= $model->activity_field ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> instagram:</label>
                        <p><?= $model->instagram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">linkedin:</label>
                        <p><?= $model->linkedin ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">twitter:</label>
                        <p><?= $model->twitter ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">whatsapp:</label>
                        <p><?= $model->whatsapp ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> telegram:</label>
                        <p><?= $model->telegram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">activity_description:</label>
                        <p><?= $model->activity_description ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::a('ویرایش', ['update', 'id' => $model->id],
                    ['class' => 'btn btn-outline-info btn-rounded']) ?>
            </div>
        </div>

        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('services'); ?>
        <?php Pjax::begin(['id' => 'p-jax-mentor-services', 'enablePushState' => false]); ?>
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
                            'data-url' => Url::to(['/mentor-services/create', 'id' => $model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-mentor-services',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>picture</th>
                    <th>title</th>
                    <th>Description</th>
                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->mentorServices): ?>
                    <?php foreach ($model->mentorServices as $i => $item): ?>
                        <td><?= $i ?></td>
                        <td><img style="width: 30px;height: 30px;" src="<?= $item->getUploadUrl('picture') ?>"></td>
                        <td><?= $item->title ?></td>
                        <td><?= $item->description ?></td>
                        <td class="float-right">
                            <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                [
                                    'title' => Yii::t('yii', 'delete'),
                                    'aria-label' => Yii::t('yii', 'delete'),
                                    'data-reload-pjax-container' => 'p-jax-business-member',
                                    'data-pjax' => '0',
                                    'data-url' => Url::to(['/mentor-services/delete', 'id' => $item->id, 'model_id' => $model->id]),
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
                                    'data-url' => Url::to(['/mentor-services/update', 'id' => $item->id, 'model_id' => $model->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-business-Statistics',
                                    'data-reload-pjax-container-on-show' => 0
                                ]) ?>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('records'); ?>
        <?php Pjax::begin(['id' => 'p-jax-mentor-records', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">سابقه ها</h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/mentor/create-records','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-mentor-records',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php if($model->records): ?>
                        <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-outline-info float-right ",
                                'data-size' => 'modal-xl',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['/mentor/update-records','id'=>$model->id]),
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
                    <th>year</th>
                    <th>title</th>
                    <th>description</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->records): ?>
                    <?php foreach ($model->records as $i => $item): ?>
                        <td><?= $i ?></td>
                        <td><?= $item['year'] ?></td>
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
        <?php $this->beginBlock('gallery'); ?>
        <?php Pjax::begin(['id' =>'p-jax-mentor-pic', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"> گالرس عکس ها </h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/mentor/pic-create','id'=>$model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-mentor-pic',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
                <?php if($model->picture_mentor || $model->picture || $model->video ): ?>
                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-info float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/mentor/pic-update','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-mentor-pic',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                <?php endif; ?>
            </div>
            <div class="row my-3">
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس مشاور</label>
                        <img src="<?= $model->getUploadUrl('picture_mentor') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس</label>
                        <img src="<?= $model->getUploadUrl('picture') ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class=" card my-3">
                        <label class="card-header">ویديو</label>
                        <video width="100%" controls="">
                            <source src=""<?= $model->getUploadUrl('video') ?>">
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'mentor'),
                    'content' => $this->blocks['mentor'],
                ],
                [
                    'label' => Yii::t('app', 'services'),
                    'content' => $this->blocks['services'],
                ],
                [
                    'label' => Yii::t('app', 'records'),
                    'content' => $this->blocks['records'],
                ],
                [
                    'label' => Yii::t('app', 'gallery'),
                    'content' => $this->blocks['gallery'],
                ],

            ]
        ]); ?>
    </div>
</div>
