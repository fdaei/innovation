<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */
/** @var \backend\models\FreelancerSkills $freelancerSkills */
/** @var \backend\models\FreelancerRecordJob $freelancerRecordJob */
/** @var \backend\models\FreelancerRecordEducational $freelancerRecordEducational */
/** @var \backend\models\FreelancerPortfolio $freelancerPortfolio */

$this->title = Yii::t('app','Create Freelancer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Freelancers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freelancer-create">

    <?= $this->render('_form', [
        'model' => $model,
        'freelancerSkills' => $freelancerSkills,
        'freelancerRecordJob' => $freelancerRecordJob,
        'freelancerRecordEducational' => $freelancerRecordEducational,
        'freelancerPortfolio' => $freelancerPortfolio,
    ]) ?>

</div>
