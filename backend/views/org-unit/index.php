<?php

use common\models\OrgUnit;
use common\models\OrgUnitSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var OrgUnitSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Org Units');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="org-unit-index card material-card">
    <?php Pjax::begin(['id' => 'p-org-unit-form', 'enablePushState' => false]); ?>

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
                    <?= Html::a(Yii::t('app', 'Create Org Unit'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-primary",
                            'data-size' => 'modal-md',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/org-unit/create']),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-org-unit-form',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
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
                'title',
                [
                    'attribute' => 'description',
                    'value' => function (OrgUnit $model) {
                        return substr($model->description, 0, 100);
                    },
                ],
                [
                    'attribute' => 'status',
                    'value' => function (OrgUnit $model) {
                        return OrgUnit::itemAlias('Status', $model->status);
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, OrgUnit $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'delete' => function ($url, OrgUnit $model, $key) {
                            return Html::a('<i class="fa fa-trash"></i>', 'javascript:void(0)', [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-reload-pjax-container' => 'p-org-unit-form',
                                'data-pjax' => '0',
                                'data-url' => Url::to(['org-unit/delete', 'id' => $model->id]),
                                'class' => 'p-jax-btn text-danger',
                                'data-title' => Yii::t('yii', 'Delete'),
                                'data-toggle' => 'tooltip',
                            ]);
                        },
                        'update' => function ($url, OrgUnit $model, $key) {
                            return Html::a('<i class="fa fa-pen"></i>', "javascript:void(0)", [
                                'data-pjax' => '0',
                                'class' => "btn text-primary",
                                'data-size' => 'modal-md',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['org-unit/update', 'id' => $model->id]),
                                'data-handle-form-submit' => 1,
                                'data-reload-pjax-container' => 'p-org-unit-form',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
