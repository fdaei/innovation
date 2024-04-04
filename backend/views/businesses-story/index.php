<?php

use common\models\BusinessesStory;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BusinessesStorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Businesses Stories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-story-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Businesses Story'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'businesses_id',
            'year',
            'title',
            'texts',
            //'picture:ntext',
            //'updated_by',
            //'updated_at',
            //'created_at',
            //'created_by',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, BusinessesStory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
