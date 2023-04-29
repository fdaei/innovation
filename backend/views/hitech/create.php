<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */

$this->title = 'هایتک جدید';
$this->params['breadcrumbs'][] = ['label' => 'هایتک', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
