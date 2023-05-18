<?php

use common\models\Freelancer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FreelancerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Freelancers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-body card">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'header_picture_desktop',
//            'header_picture_mobile',
//            'freelancer_picture',
//            'freelancer_description:ntext',
            'name',
            //'sex',
            'email:email',
            'mobile',
            //'city',
            //'province',
            //'marital_status',
            //'military_service_status',
            //'activity_field',
            //'experience',
            //'experience_period',
            //'skills',
            //'record_job',
            //'record_educational',
            //'portfolio',
            //'resume_file',
            //'description_user:ntext',
            //'project_number',
            //'status',
            //'updated_by',
            //'updated_at',
            //'created_at',
            //'created_by',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Freelancer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
