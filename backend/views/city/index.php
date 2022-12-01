<?php

use common\models\City;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\City $model */

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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, City $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
