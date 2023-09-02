<?php

use common\models\JobPosition;
use common\models\JobPositionSearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var JobPositionSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Positions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-position-index card material-card">
    <?php Pjax::begin(['id' => 'p-job-position-form', 'enablePushState' => false]); ?>
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
                    <?= Html::a(Yii::t('app', 'Create Job Positions'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-primary",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/job-position/create']),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-job-position-form',
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
                    'attribute' => 'immediate',
                    'value' => function ($model) {

                        return JobPosition::itemAlias('Immediate', $model->immediate);
                    },
                ],
                [
                    'attribute' => 'org_unit_id',
                    'value' => 'orgUnit.title',
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, JobPosition $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'template' => '{update} {view} {delete}',
                    'buttons' => [
                        'update' => function ($url, JobPosition $model, $key) {
                            return Html::a('<i class="fa fa-pen"></i>', "javascript:void(0)", [
                                'data-pjax' => '0',
                                'class' => "btn text-primary",
                                'data-size' => 'modal-md',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['job-position/update', 'id' => $model->id]),
                                'data-handle-form-submit' => 1,
                                'data-reload-pjax-container' => 'p-job-position-form',
                            ]);
                        },
                        'view' => function ($url, JobPosition $model, $key) {
                            return Html::a('<i class="fa fa-eye"></i>', "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'class' => "btn text-info p-0",
                                    'data-size' => 'modal-md',
                                    'data-title' => Yii::t('app', 'view'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['job-position/view', 'id' => $model->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-reload-pjax-container' => 'p-job-position-form'
                                ]
                            );
                        },
                        'delete' => function ($url, JobPosition $model, $key) {
                            return Html::a('<i class="fa fa-trash"></i>', 'javascript:void(0)', [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-reload-pjax-container' => 'p-job-position-form',
                                'data-pjax' => '0',
                                'data-url' => Url::to(['job-position/delete', 'id' => $model->id]),
                                'class' => 'p-jax-btn text-danger m-2',
                                'data-title' => Yii::t('yii', 'Delete'),
                                'data-toggle' => 'tooltip',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>