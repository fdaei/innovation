<?php

use common\models\Event;
use common\models\EventAttendance;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var Event $model */

$this->title = Yii::t('app', 'EventAttendances');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'EventAttendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="event-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($model->title) ?></h1>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getEventAttendances(),
            ]),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'first_name',
                'last_name',
                'mobile',
                'email',
                'description',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
