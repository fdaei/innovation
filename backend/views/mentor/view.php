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
        <div class="card border-primary">
            <div class="card-body row">
                <div class="col-12 row">
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Name')?> :</label>
                        <p><?= $model->name ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Activity Field')?> :</label>
                        <p><?= $model->activity_field ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Instagram')?> :</label>
                        <p><?= $model->instagram ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'LinkedIn')?> :</label>
                        <p><?= $model->linkedin ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Twitter')?> :</label>
                        <p><?= $model->twitter ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'WhatsApp')?> :</label>
                        <p><?= $model->whatsapp ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Telegram')?> :</label>
                        <p><?= $model->telegram ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Consultation Face-to-Face Cost')?> :</label>
                        <p><?= $model->consultation_face_to_face_cost ?></p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="fw-bold"><?= Yii::t('app', 'Consultation Online Cost')?> :</label>
                        <p><?= $model->consultation_online_cost ?></p>
                    </div>
                    <div class="col-md-12">
                        <label class="fw-bold"><?= Yii::t('app', 'Activity Description')?> :</label>
                        <p><?= $model->activity_description ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::a('<i class="bi bi-pencil"></i> ویرایش', ['update', 'id' => $model->id],
                    ['class' => 'btn btn-outline-primary']) ?>
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
                            'data-size' => 'modal-md',
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
                    <th><?= Yii::t('app', 'picture')?></th>
                    <th><?= Yii::t('app', 'title')?></th>
                    <th><?= Yii::t('app', 'Description')?></th>
                    <th><?= Yii::t('app', 'action')?></th>
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
                                    'data-reload-pjax-container' => 'p-jax-mentor-services',
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
                                    'data-reload-pjax-container' => 'p-jax-mentor-services',
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
        <?php Pjax::begin(['id' => 'p-jax-mentor-records','enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">رکورد ها</h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ml-1",
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
                                'data-url' => Url::to(['/mentor/update-records','id' => $model->id]),
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
                    <th>سال</th>
                    <th>عنوان</th>
                    <th>توضیحات</th>
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
                            'class' => "btn btn-outline-info float-right mx-1",
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
