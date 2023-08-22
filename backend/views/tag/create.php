<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tag $model */

$this->title = 'Create Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-unit-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,

        ]) ?>

    </div>
</div>
