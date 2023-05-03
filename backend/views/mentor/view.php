<?php

use common\models\Statuses;
use voime\GoogleMaps\Map;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('mentor'); ?>
        <div class="card">
            <div class="card-header my-3">
                <h3 class="float-left "> گالرس عکس ها </h3>
            </div>
            <div class="card-body row">
                <div class="col-12 row">
                    <div class="col-3">
                        <label for="name">Name:</label>
                        <p><?= $model->name ?></p>
                    </div>
                    <div class="col-3">
                        <label for="email">activity_field:</label>
                        <p><?= $model->activity_field ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> instagram:</label>
                        <p><?= $model->instagram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">linkedin:</label>
                        <p><?= $model->linkedin ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">twitter:</label>
                        <p><?= $model->twitter ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">whatsapp:</label>
                        <p><?= $model->whatsapp ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> telegram:</label>
                        <p><?= $model->telegram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">activity_description:</label>
                        <p><?= $model->activity_description ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info"> ویرایش</button>
            </div>
        </div>

        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('services'); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">خدمت ها</h3>
                    <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>Description</th>
                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->services as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td class="float-right">
                        <button class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-outline-info border-0"><i class="fa fa-pencil"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('history'); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">سابقه ها</h3>
                    <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>number</th>
                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->records as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['year'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td class="float-right">
                        <button class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-outline-info border-0"><i class="fa fa-pencil"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('gallery'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"> گالرس عکس ها </h3>
                <button class="btn btn-success float-right"><i class="fa fa-plus"></i></button>
            </div>
            <div class="row my-3">
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس مشاور</label>
                        <img src="<?= $model->getUploadUrl('picture_mentor') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس</label>
                        <img src="<?= $model->getUploadUrl('picture') ?>">
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class=" card my-3">
                        <label class="card-header">ویديو</label>
                        <video width="100%" controls="">
                            <source src=""<?= $model->getUploadUrl('video') ?>">
                        </video>
                        <div class="card-footer">
                            <button class="btn btn-info">ویرایش</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'mentor'),
                    'content' => $this->blocks['mentor'],
                ],
                [
                    'label' => Yii::t('app', 'services'),
                    'content' => $this->blocks['services'],
                ],
                [
                    'label' => Yii::t('app', 'history'),
                    'content' => $this->blocks['history'],
                    'content' => $this->blocks['history'],
                ],
                [
                    'label' => Yii::t('app', 'gallery'),
                    'content' => $this->blocks['gallery'],
                ],

            ]
        ]); ?>
    </div>
</div>
