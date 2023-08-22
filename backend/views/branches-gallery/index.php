<?php

use common\models\BranchesGallery;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\BranchesGallerySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Branches Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-gallery-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a(Yii::t('app', 'Create Branches Gallery'), ['create'], ['class' => 'btn btn-primary']) ?>

        </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'branche_id',
                    'value' => function ($model) {

                        return "--";
                    },
                ],
                'status',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, BranchesGallery $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
