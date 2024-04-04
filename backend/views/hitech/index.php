<?php

use common\models\Hitech;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\HitechSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'هایتک';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a(Yii::t('app', 'هایتک جدید'), ['create'], ['class' => 'btn btn-primary ']) ?>

        </p>

    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
//            'required_skills',
            'minimum_budget',
            //'maximum_budget',
            //'status',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Hitech $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
