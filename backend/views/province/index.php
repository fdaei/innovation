<?php

use common\models\Province;
use common\models\ProvinceSearch;

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use common\widgets\grid\GridView;
use common\widgets\grid\ActionColumn;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
/** @var View $this */
/** @var ProvinceSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Provinces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h2><?= Html::encode($this->title) ?></h2>
        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right " data-toggle="modal"  data-target="#add-contact">
            <?= Html::a(Yii::t('app', 'Create Province'), ['create'], ['class' => 'text-white']) ?>
        </button>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'status',
                'value' => function ($model) {

                    return Province::itemAlias('Status',$model->status);
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Province $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
