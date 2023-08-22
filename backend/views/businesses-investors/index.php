<?php

use common\models\BusinessesInvestors;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\BusinessesInvestorsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Businesses Investors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-investors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Businesses Investors'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'businesses_id',
            'picture:ntext',
            'title',
            'description',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, BusinessesInvestors $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
