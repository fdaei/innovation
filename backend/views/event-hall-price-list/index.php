<?php

use common\models\EventHallPriceList;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\EventHallPriceListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Event Hall Price Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-hall-price-list-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a(Yii::t('app', 'Create Event Hall Price List'), ['create'], ['class' => 'btn btn-primary']) ?>

        </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'event_hall_id',
                'day',
                'price',
                'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',
                //'deleted_at',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, EventHallPriceList $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
