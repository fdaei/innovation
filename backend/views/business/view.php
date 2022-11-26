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
        <?php echo Html::img('@web/uploads/'.$model->logo) ?>
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
                    'attribute'=>'logo',
                    'value'=>Html::img(Yii::getAlias('@web').'/uploads/'.$model->logo),
                ],
                [
                        'label' => 'Your Image',
                    'value'=>function($model){
                        return('@web/uploads/'.$model->logo);
                    },

                ],
                'wallpaper',
                'mobile_wallpaper',
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
                    'image',
                    'mobile_image',
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
                    'image',
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
                    'icon',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('TimelineItems'); ?>
        <?php foreach ($timelineitems as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'id',
                    'business_timeline_id',
                    'description:ntext',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Timeline'); ?>
        <?php foreach ($timeline as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'id',
                    'year',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
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
                    'label' => 'TimelineItems',
                    'content' => $this->blocks['TimelineItems'],
                ],
                [
                    'label' => 'Stat',
                    'content' => $this->blocks['Stat'],
                ],
            ]
        ]); ?>
    </div>
</div>