<?php

/** @var common\models\User $model */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile')];
?>
<div class="container emp-profile bg-white">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <i class="fal fa-user-circle fa-10x m-3"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-info my-4" >Edite Profile</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label><?=Yii::t('app', 'Username')?></label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $model->username?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><?=Yii::t('app', 'Email')?></label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $model->email ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><?=Yii::t('app', 'Created By')?></label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $model->created_at ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>