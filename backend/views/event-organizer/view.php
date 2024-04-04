<?php

use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Teachers', 'url' => ['index']];
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
    <div class="row">
        <div class="col-6 d-flex justify-content-center">
            <img width="25%" height="70%" src="<?= $model->getUploadUrl('organizer_avatar') ?>">
        </div>
        <div class="col-6 d-flex justify-content-center">
            <img width="25%" height="70%" src="<?= $model->getUploadUrl('organizer_picture') ?>">
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>organizer_name</th>
            <th>organizer_title_brief</th>
            <th>organizer_instagram</th>
            <th>organizer_telegram</th>
            <th>organizer_linkedin</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $model->organizer_name ?></td>
            <td><?= $model->organizer_title_brief ?></td>
            <td><?= $model->organizer_instagram ?></td>
            <td><?= $model->organizer_telegram ?></td>
            <td><?= $model->organizer_linkedin ?></td>
            <td class="float-right">
            </td>
        </tr>
        </tbody>
    </table>
</div>
