<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="">
    <div class="row">
        <div class="col-4">
            <div class="  card text-white bg-primary" >
                <div class="card-header"><?= Yii::t('app', 'Number of business') ?></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h1><p class="card-text"><?= \common\models\Business::find()->count() ?></p></h1>
                        <h1>
                            <i class="fa fa-business-time"></i>
                        </h1>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="fa fa-caret-left mr-2"></i>
                        <p class=" text-white"><?= Html::a(Yii::t('app', 'list of business'), ['/business'], ["class" => "text-white"]) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class=" card text-white bg-info ">
                <div class="card-header"><?= Yii::t('app', 'Number of CareerApply') ?></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h1><p class="card-text"><?= \common\models\CareerApply::find()->count() ?></p></h1>
                        <h1>

                            <i class="fa fa-file-archive"></i>
                        </h1>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="fa fa-caret-left mr-2"></i>
                        <p class=" text-white"><?= Html::a(Yii::t('app', 'list of CareerApply'), ['/career-apply'], ["class" => "text-white"]) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class=" card text-white bg-secondary " >
                <div class="card-header"><?= Yii::t('app', 'Number of JobPosition') ?></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h1><p class="card-text"><?= \common\models\JobPosition::find()->count() ?></p></h1>
                        <h1>
                            <i class="fa fa-server"></i>
                        </h1>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="fa fa-caret-left mr-2"></i>
                        <p class="text-white"><?= Html::a(Yii::t('app', 'list of JobPosition'), ['/job-position'], ["class" => "text-white"]) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
