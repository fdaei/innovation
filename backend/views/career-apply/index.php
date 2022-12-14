<?php

use common\models\CareerApplySearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var CareerApplySearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Career Applies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-apply-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'first_name',
                'last_name',
                'mobile',
                [
                    'class' => ActionColumn::class,
                    'template' => '{view} {delete}',
                    // display conditional buttons
                    'visibleButtons' => [
                        'update' => false,
                        'create' => false
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>