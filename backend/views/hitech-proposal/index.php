<?php

use common\models\HitechProposal;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\HitechProposalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hitech Proposals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">


    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hitech_id',
            'name',
            'mobile',
            'description:ntext',
            //'status',
            //'updated_at',
            //'created_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HitechProposal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
