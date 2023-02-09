<?php

use common\models\Mentors;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\MentorsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Mentors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentors-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Mentors'), ['create'], ['class' => 'btn btn-info btn-rounded']) ?>

    </p>
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
            'name',
            'telegram',
            'instagram',
            'whatsapp',
            'activity_field',
            'profile_pic',
            'activity_description:ntext',
            'consulting_fee',
            'consultation_face_to_face',
            'consultation_online',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Mentors $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
