<?php

use common\models\Notification;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\NotificationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
            'receiver',
            [
                'attribute' => 'type',
                'value' => function ($model) {

                    return Notification::itemAlias('Type',$model->type);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {

                    return Notification::itemAlias('Status',$model->status);
                },
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                // display conditional buttons
                'visibleButtons' => [
                    'update' => false,
                    'create' => false,
                    'delete' => false,
                ],
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
