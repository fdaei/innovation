<?php

use common\models\Event;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\EventSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Event'), ['create'], ['class' => 'btn btn-primary']) ?>

        </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'price',
                'price_before_discount',
                'address:ntext',
                [
                    'class' => ActionColumn::class,
                    'template' => '{view} {update} {delete} {attendance}',
                    'buttons' => [
                        'attendance' => function ($url, Event $model, $key) {
                            return Html::a(Yii::t('app', '<i class="fa fa-user"></i>'), Url::to(['event-attendance', 'id' => $model->id]), [
                                'class' => 'text-primary',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
