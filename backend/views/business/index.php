<?php

use common\models\Business;
use common\models\BusinessSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
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
        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a(Yii::t('app', 'Create Business'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
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
                        if ($model->status == 2) {
                            return "inactive";
                        } elseif ($model->status == 1) {
                            return "active";
                        }
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