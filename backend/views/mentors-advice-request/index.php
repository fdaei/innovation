<?php

use common\models\MentorsAdviceRequest;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Mentors Advice Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentors-advice-request-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Mentors Advice Request'), ['create'], ['class' => 'btn btn-info btn-rounded']) ?>

    </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'mentor_id',
            'description:ntext',
            'date_advice',
            'type',
            'file',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MentorsAdviceRequest $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
