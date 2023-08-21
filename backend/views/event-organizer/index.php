<?php

use common\models\EventOrganizer;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\EventOrganizerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'برگذار کنندگان';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <p>
        <?= Html::a('برگذار کنننده جدید', ['create'], ['class' => 'btn btn-primary float-right']) ?>
    </p>

    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'organizer_name',
            'organizer_title_brief',
            'organizer_instagram',
            'organizer_telegram',

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, EventOrganizer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
