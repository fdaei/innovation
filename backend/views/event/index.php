<?php

use common\models\Event;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\EventSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Event'), ['create'], ['class' => 'btn btn-primary']) ?>

    </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'price',
            'price_before_discount',
            'address:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Event $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
