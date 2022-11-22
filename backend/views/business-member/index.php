<?php

use common\models\BusinessMember;
use common\models\BusinessMemberSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var BusinessMemberSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Business Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between">

        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a(Yii::t('app', 'Create Business Member'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'first_name',
                'last_name',
                'position',

                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, BusinessMember $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>