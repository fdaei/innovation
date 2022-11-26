<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timeline Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="business-timeline-item-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                ],
                ]) ?>
            </p>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => ['id',
            'business_timeline_id:datetime',
            'description:ntext',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            ],
            ]) ?>
        </div>
    </div>
