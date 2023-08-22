<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimeline $model */
/** @var common\models\BusinessTimelineItem $TimelineItem */

$this->title = Yii::t('app', 'Create Business Timeline');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timelines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
