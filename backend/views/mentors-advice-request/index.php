<?php

use common\models\MentorsAdviceRequest;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Mentors Advice Requests');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mentors-advice-request-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'mobile',
                [
                    'attribute' => 'mentor_id',
                    'value' => function ($model) {
                        return $model->mentor?->name;
                    },
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function (MentorsAdviceRequest $model) {
                        return $model->user?->username;
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, MentorsAdviceRequest $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                ],
            ],
        ]); ?>

    </div>
    <?php Pjax::end(); ?>
</div>
