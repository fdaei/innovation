<?php

use common\models\BusinessTimeline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\models\BusinessTimelineItem $TimelineItem */

$this->title = Yii::t('app', 'Business Timelines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between">

        <h2><?= Html::encode($this->title) ?></h2>

        <p>
            <?= Html::a(Yii::t('app', 'Create Business Timeline'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'year',
                [
                    'attribute'=>'status',
                    'value'=>function($model){
                        if($model->status==2)
                        {
                            return "inactive";
                        }elseif ($model->status==1){
                            return "active";
                        }
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, BusinessTimeline $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
