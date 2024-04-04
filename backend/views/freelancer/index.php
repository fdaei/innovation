<?php

use common\models\Freelancer;
use common\models\FreelancerSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;

/** @var View $this */
/** @var FreelancerSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

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
                <?= Html::a(Yii::t('app', 'Create Freelancer'), ['create'], ['class' => 'btn btn-primary']) ?>

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
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'email:email',
                'mobile',
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