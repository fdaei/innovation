<?php

use common\models\MentorCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\MentorCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Mentor Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentor-category-index card material-card">
    <div class="card-header d-flex justify-content-between pb-0">
    <h4 class="pt-2">
        <a class="accordion-toggle collapsed"
           data-toggle="collapse" data-parent="#accordion"
           href="#collapseSearchModel" aria-expanded="false">
            <i class="far fa-search"></i>
            جستجو
        </a>
    </h4>
    <p>
        <?= Html::a(Yii::t('app', 'Create Mentor Category'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
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
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, MentorCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
