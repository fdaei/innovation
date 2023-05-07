<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BusinessTimeline $model */
/** @var backend\models\BusinessTimelineItem $TimelineItem */

$this->title = Yii::t('app', 'Update Business Timeline: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timelines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'TimelineItem' => $TimelineItem
        ]) ?>
    </div>
</div>
