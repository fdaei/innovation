<?php

use common\models\Mentor;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\MentorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'مشاوران';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentor-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('مشاور جدید', ['create'], ['class' => 'btn btn-primary']) ?>

    </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'whatsapp',
            'activity_field',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Mentor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
