<?php

use common\models\Businesses;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BusinessesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'کسب و کار ها';
$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::t('app', 'Businesses');
?>
<div class="card card-body">
    <p>
        <?= Html::a('کسب و کار جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'

            ],

            'id',
            'name',
            'website',
            'telegram',
            'instagram',
            'whatsapp',
//            'statistics',
//            'services',
//            'investors',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Businesses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
            ]
        ],
    ]); ?>


</div>
