<?php

use common\models\Business;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
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
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'user_id',
                'city_id',
                'title',
                'slug',
                'link',
                [
                    'attribute' => 'logo',
                    'value' => Html::img($model->getUploadUrl('logo'), array('width' => 150, 'height' => 150)),
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'wallpaper',
                    'value' => Html::img($model->getUploadUrl('wallpaper'), array('width' => 400, 'height' => 150)),
                    'format' => 'raw',

                ],
                [
                    'attribute' => 'mobile_wallpaper',
                    'value' => Html::img($model->getUploadUrl('mobile_wallpaper'), array('width' => 150, 'height' => 150)),
                    'format' => 'raw'
                ],
                'investor_description',
                'short_description:ntext',
                'success_story:ntext',
                'status',
            ],
        ]) ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Galleries'); ?>
        <?php foreach ($gallery as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    [
                        'attribute' => 'image',
                        'value' => Html::img($item->getUploadUrl('image'), array('width' => 150, 'height' => 150)),
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'mobile_image',
                        'value' => Html::img($item->getUploadUrl('mobile_image'), array('width' => 150, 'height' => 150)),
                        'format' => 'raw',

                    ],
                    'title',
                    'description:ntext',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Members'); ?>
        <?php foreach ($members as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'first_name',
                    'last_name',
                    [
                        'attribute' => 'image',
                        'value' => Html::img($item->getUploadUrl('image'), array('width' => 150, 'height' => 150)),
                        'format' => 'raw',

                    ],
                    'position',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Stat'); ?>
        <?php foreach ($stat as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'type',
                    'title',
                    'subtitle',
                    [
                        'attribute' => 'icon',
                        'value' => Html::img($item->getUploadUrl('icon'), array('width' => 150, 'height' => 150)),
                        'format' => 'raw',

                    ],
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Timeline'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <?= Html::a('create Item', ['/business-timeline-item/create'], ['class' => 'btn btn-outline-success btn-sm float-right m-1', "method" => "post"]) ?>
                            <?= Html::a('create Time', ['/business-timeline/create'], ['class' => 'btn btn-outline-success btn-sm float-right m-1', "method" => "post"]) ?>
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
                                        <li class="<?= $i === 0 ? 'selected' : '' ?>"
                                            data-date="01/01/<?= $item->year ?>">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h3><?= $item->convert([$item->year]) ?></h3>
                                                    <h3><?= $item->year ?></h3>
                                                </div>
                                            </div>
                                            <?php foreach ($item->timeLineIem as $it): ?>
                                                <p class="pt-3">
                                                    <?= $it->description ?>
                                                    <?= Html::a('<i class="fas fa-trash"></i>', ['/business-timeline-item/delete', 'id' => $it->id], ['class' => ' btn  btn btn-outline-secondary btn-sm float-right m-1', "data-method" => "post"]) ?>
                                                    <?= Html::a('<i class="fas fa-pen"></i>', ['/business-timeline-item/update', 'id' => $it->id], ['class' => 'btn btn-outline-secondary btn-sm float-right m-1', "method" => "post"]) ?>
                                                </p>
                                            <?php endforeach; ?>
                                            <p>
                                                <?= Html::a('<i class="fas fa-trash"></i>', ['/business-timeline/delete', 'id' => $item->id], ['class' => 'btn  btn btn-outline-info btn-sm  mt-5', "data-method" => "post"]) ?>
                                                <?= Html::a('<i class="fas fa-pen"></i>', ['/business-timeline/update', 'id' => $item->id], ['class' => 'btn  btn btn-outline-info btn-sm  mt-5', "method" => "post"]) ?>
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