<?php

use common\models\CareerApply;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\CareerApplySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

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
                [
                    'attribute' => 'user_id',
                    'value' => 'user.username',
                ],
                'first_name',
                'last_name',
                'mobile',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    // display conditional buttons
                    'visibleButtons' => [
                        'update' => false,
                        'create'=>false
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
