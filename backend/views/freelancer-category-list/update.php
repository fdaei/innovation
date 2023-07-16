<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FreelancerCategoryList $model */

$this->title = Yii::t('app', 'Update', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancer Category Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="freelancer-category-list-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
