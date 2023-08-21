<?php

use common\models\Branches;
use common\models\Statuses;
use common\widgets\grid\GridView;
use common\widgets\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\BranchesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Branches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a(Yii::t('app', 'Create Branches'), ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'address:ntext',
                'mobile',
                'phone',
                'desk_count',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {

                        return Statuses::find()->where(['id' => $model->status])->one()->title_fa;
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Branches $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>