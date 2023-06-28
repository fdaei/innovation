<?php

use common\models\Freelancer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\FreelancerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Freelancers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index card material-card">
    <div class="panel-group m-bot20" id="accordion">
        <div class="card-header d-flex justify-content-between">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSearchModel" aria-expanded="false">
                    <i class="far fa-search"></i> جستجو
                </a>
            </h4>
            <div>
                <?= Html::a(Yii::t('app', 'Create Freelancer'), ['create'], ['class' => 'btn btn-success']) ?>

            </div>
        </div>
        <div id="collapseSearchModel" class="panel-collapse collapse p-3" aria-expanded="false" style="">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">

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
    <?php Pjax::end(); ?>

</div>