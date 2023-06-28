<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */

$this->title = 'ویرایش: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="freelancer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
