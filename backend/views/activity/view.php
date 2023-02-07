<?php

use common\models\Activity;

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Activity $model */
/** @var common\models\ActivityComment $comment */
/** @var common\models\ActivityComment $comments */



$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between row">
            <div class="card text-left mx-auto col-12">
                <div class="card-body">
                    <label class="text-muted"><?= Yii::t('app', 'Status') ?></label>
                    <?= Html::a( Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger float-right','data-method'=>'post']) ?>
                    <h6  class="border-bottom"> <?= $model->status ?></h6>
                    <label><?= Yii::t('app', 'title') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?= $model->title ?></h6>
                    <label><?= Yii::t('app', 'Created By') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?= $model->createdBy->username ?></h6>
                    <label><?= Yii::t('app', 'Assignment') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?= $model->activityUserAssignments[0]->user->username ?></h6>
                </div>
                <p class="alert alert-info">Comments</p>
                <div class="container">
                    <div class="d-flex justify-content-center row">
                        <?php foreach ($comments as $i): ?>
                        <div class="col-md-12 border border-1 border- m-2 ">
                            <div class="d-flex flex-column comment-section">
                                <div class="bg-white p-2">
                                    <div class="mt-2">
                                        <p class="comment-text"><?= $i->comment ?></p>
                                    </div>
                                    <span class="float-left">
                                        <span>ایجاد شده توسط :</span>
                                        <span class="comment-text"><?= $i->createdBy->username ?></span>
                                    </span>
                                    <span class="float-right ">
                                        <p class="comment-text"><?= Yii::$app->pdate->jdate('y/m/d',$i->created_at) ?></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                    <fieldset>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
                                <?= $form->field($comment, 'comment')->textarea() ?>
                            </div>
                        </div>
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
