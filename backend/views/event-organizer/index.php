<?php

use common\models\EventOrganizer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'برگذار کنندگان';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <p>
        <?= Html::a('برگذار کنننده جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'organizer_name',
            'organizer_avatar',
            'organizer_picture',
            'organizer_title_brief',
            //'organizer_instagram',
            //'organizer_telegram',
            //'organizer_linkedin',
            //'updated_at',
            //'updated_by',
            //'created_at',
            //'created_by',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EventOrganizer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
