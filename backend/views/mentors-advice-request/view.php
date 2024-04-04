<?php

use common\models\MentorsAdviceRequest;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Freelancer; // Import the Freelancer model or adjust the namespace as needed

/** @var yii\web\View $this */
/** @var common\models\MentorRequest $model */

$this->title =  $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentor Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mentor-request-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'user_id',
                        'value' => $model->user->username,
                    ],
                    [
                        'attribute' => 'mentor_id',
                        'value' => $model->mentor->name,
                    ],
                    'name',
                    'mobile',
                    'description:ntext',
                    [
                        'attribute' => 'status',
                        'value' => $model->status ? MentorsAdviceRequest::itemAlias('Status', $model->status) : '',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
