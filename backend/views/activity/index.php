<?php

use common\models\Activity;
use common\models\Statuses;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\ActivitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Activity');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right " data-toggle="modal" data-target="#add-contact">
            <?= Html::a(Yii::t('app', 'Create Activity'), ['create'], ['class' => 'text-white']) ?>
        </button>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options'=>['class'=>'grid-view','id'=>'grid_id_1'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model) {

                  return true;
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{view}',
                    // display conditional buttons
                    'visibleButtons' => [
                        'update' => false,
                        'create' => false,
                        'delete' => false,
                    ],
                ],
            ],
        ]); ?>
        <select id="dropdown">
            <?php foreach (Statuses::find()->where(['type'=>'activity'])->all() as $i => $item): ?>
            <option value=<?= $item['title_fa'] ?>  <?php $item['id']==8?"selected":""?>><?= $item['title_fa'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php Pjax::end(); ?>

</div>
