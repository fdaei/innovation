<?php

use backend\modules\changeLog\models\ChangeLog;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ChangeLogQuery = ChangeLog::find()->unread()->orderBy(['created_at' => SORT_DESC]);
$dataProvider = new ActiveDataProvider(['query' => $ChangeLogQuery, 'sort' => false, 'pagination' => ['pageSize' => 10]]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['attribute' => 'title',
         'content'   => function($model) {

             return Html::a($model->title, 'javascript:void(0)',
                 [
                     'title'       => Yii::t('app', 'View'),
                     'id'          => 'view-btn',
                     'class'       => 'text-info',
                     'data-size'   => 'modal-xl',
                     'data-title'  => Yii::t('app', 'View'),
                     'data-toggle' => 'modal',
                     'data-target' => '#modal-pjax',
                     'data-url'    => Url::to(['/changeLog/changes/view', 'id' => (string)$model->_id]),
                 ]);
         },
         'format'    => 'RAW',
        ],
    ],
]);
?>
<div class="text-right card-footer">
    <?= Html::a(Yii::t('app', 'List View'), Url::to(['/changeLog/changes']), ['class' => 'btn btn-info']) ?>
</div>