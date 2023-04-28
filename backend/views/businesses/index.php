<?php

use common\models\Businesses;
use common\widgets\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
//use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BusinessesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::t('app', 'Businesses');
?>
<div class=" p-3 card material-card rounded-lg custom_color">
    <div class="d-flex flex-row justify-content-between">
        <h1 class="custom_color"><?= Html::encode($this->title) ?></h1>
        <p class="">
            <?= Html::a('ایجاد کسب و کار جدید', ['create'], ['class' => 'btn custom_background_color rounded-pill text-white']) ?>
        </p>
    </div>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
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
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Businesses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
            ]
        ],
    ]); ?>


</div>
