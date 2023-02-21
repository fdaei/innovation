<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Branches $model */
/** @var common\models\BranchesAdmin $admin */

$this->title = Yii::t('app', 'Create Branches');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">    <?= $this->render('_form', [
            'model' => $model,
            'admin' => $admin,
        ]) ?>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        createMap();
    });
</script>
