<?php

use common\models\EventHall;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\EventHallSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Event Halls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-hall-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Event Hall'), ['create'], ['class' => 'btn btn-info btn-rounded']) ?>

        </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'branche_id',
                    'value' => function ($model) {

                        return $model->branche->title;
                    },
                ],
                'name',
                'capacity',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, EventHall $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
