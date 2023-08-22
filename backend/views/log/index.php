<?php

use common\models\Log;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index bg-white p-4">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'level',
            'category',
            [
                'attribute' => 'log_time',
                'value' => function ($model) {

                    return Yii::$app->pdate->jdate('Y/m/d H:i', $model->log_time);
                },
            ],
            'prefix:ntext',
            //'message:ntext',
            [
                'class' => ActionColumn::class,
                'template' => ' {view} {delete} ',
                'urlCreator' => function ($action, Log $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
