<?php

use common\models\City;
use common\models\CitySearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
/** @var View $this */
/** @var CitySearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var City $model */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'latitude',
            'longitude',
            [
                'attribute' => 'status',
                'value' => function ($model) {

                    return City::itemAlias('Status',$model->status);
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, City $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
