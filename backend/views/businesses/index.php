<?php

use common\models\Business;
use common\models\Businesses;
use common\models\City;
use common\models\CitySearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var CitySearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var City $model */

$this->title = Yii::t('app', 'Businesses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-position-index card material-card">
    <?php Pjax::begin(['id' => 'p-businesses-form', 'enablePushState' => false]); ?>
    <div class="card-header">
        <div class="work-report-index card ">
            <div class="panel-group m-bot20" id="accordion">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseSearch" aria-expanded="false">
                            <i class="fa fa-search"></i> جستجو
                        </a>
                    </h3>
                    <?= Html::a(Yii::t('app', 'Create Businesses'), ['create'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="collapseSearch" class="panel-collapse collapse" aria-expanded="false">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'business_color',
                'business_en_name',
                'website',
                'telegram',
                'instagram',
                'whatsapp',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {

                        return Business::itemAlias('Status', $model->status);
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Businesses $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
