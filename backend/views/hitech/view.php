<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Hiteches', 'url' => ['index']];
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
    <table class="table table-striped">
        <thead>
        <tr>
            <th>title</th>
            <th>description</th>
            <th>required_skills</th>
            <th>minimum_budget</th>
            <th>maximum_budget</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $model->title ?></td>
            <td><?= $model->description ?></td>
            <td>
                <?php foreach ($model->required_skills as $i => $item): ?>
                        <span><i class="fa fa-check p-2"></i><?= $item ?></span>
                <?php endforeach; ?>
            </td>
            <td><?= $model->minimum_budget ?></td>
            <td><?= $model->maximum_budget ?></td>
            <td class="float-right">
            </td>
        </tr>
        </tbody>
    </table>
</div>
