<?php

use common\models\FreelancerCategoryList;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\FreelancerCategoryListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Freelancer Category Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index card material-card">
    <div class="panel-group m-bot20" id="accordion">
        <div class="card-header d-flex justify-content-between">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                   href="#collapseSearchModel" aria-expanded="false">
                    <i class="far fa-search"></i> جستجو
                </a>
            </h4>
            <div>
                <?= Html::a(Yii::t('app', 'Create Freelancer Category List'), ['create'], ['class' => 'btn btn-success']) ?>

            </div>
        </div>
        <div id="collapseSearchModel" class="panel-collapse collapse p-3" aria-expanded="false" style="">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                'title',
                'brief_description',
                'picture',
                'status',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, FreelancerCategoryList $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>