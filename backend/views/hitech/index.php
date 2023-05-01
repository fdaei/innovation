<?php

use common\models\Hitech;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\HitechSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'هایتک';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <p>
        <?= Html::a('هایتک جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'required_skills',
            'minimum_budget',
            //'maximum_budget',
            //'status',
            //'updated_by',
            //'updated_at',
            //'created_at',
            //'created_by',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Hitech $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
