<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Hitech $model */

$this->title = 'ویرایش هایتک: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'هایتک', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hitech-update">

    <?= $this->render('_form', [
        'model' => $model,
        'HitechRequireSkills' =>$HitechRequireSkills
    ]) ?>

</div>
