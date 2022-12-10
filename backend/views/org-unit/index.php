<?php

use common\models\OrgUnit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\OrgUnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Org Units');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-unit-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h2><?= Html::encode($this->title) ?></h2>
        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right " data-toggle="modal"
                data-target="#add-contact">
            <?= Html::a(Yii::t('app', 'Create Org Unit'), ['create'], ['class' => 'text-white']) ?>
        </button>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'rowOptions' => function ($model) {
                if ($model->status == 1) {
//                    return ['class' => 'text-info'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'attribute' => 'description',
                    'value'=> function ($model) {

                        return substr($model->description,0,100);
                    },
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($model) {

                        return OrgUnit::itemAlias('Status', $model->status);
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, OrgUnit $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
