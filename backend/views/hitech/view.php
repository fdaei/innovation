<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hiteches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-body">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description',
            [
                'attribute' => 'required_skills',
                'value' => function ($model) {
                    $skills = '';
                    foreach ($model->required_skills as $item) {
                        $skills .= "<i class='fa fa-check p-2'></i>$item<br>";
                    }
                    return $skills;
                },
                'format' => 'raw',
            ],
            'minimum_budget',
            'maximum_budget',
        ],
    ]) ?>
</div>
