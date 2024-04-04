<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FreelancerCategoryList $model */

$this->title = Yii::t('app', 'Create Freelancer Category List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancer Category Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freelancer-category-list-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
