<?php

use common\models\Business;
use common\models\BusinessSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var BusinessSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Businesses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between">
        <h2><?= Html::encode($this->title) ?></h2>
        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right " data-toggle="modal" data-target="#add-contact">
            <?= Html::a(Yii::t('app', 'Create Business'), ['create'], ['class' => 'text-white']) ?>
        </button>
    </div>

    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'user_id',
                    'value' => 'user.username',
                ],
                [
                    'attribute' => 'city_id',
                    'value' => function ($model) {

                        return $model->city?->name;
                    },
                ],
                'title',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {

                        return Business::itemAlias('Status',$model->status);
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Business $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>