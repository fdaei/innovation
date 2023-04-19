<?php

use common\models\Businesses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BusinessesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'کسب و کار ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">
    <p>
        <?= Html::a('کسب و کار جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'picture_desktop',
            'picture_mobile',
            'name',
            'description_brief',
            //'description:ntext',
            //'website',
            //'telegram',
            //'instagram',
            //'whatsapp',
            //'pic_main_desktop',
            //'pic_main_mobile',
            //'pic_small1_desktop',
            //'pic_small1_mobile',
            //'pic_small2_desktop',
            //'pic_small2_mobile',
            //'statistics',
            //'services',
            //'investors',
            //'status',
            //'updated_at',
            //'updated_by',
            //'created_by',
            //'created_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Businesses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
