<?php

use common\models\User;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $identity User */

$identity = Yii::$app->user->identity;

?>
<ul class="navbar-nav float-right">
    <?php if (!Yii::$app->user->isGuest): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href=""
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fal fa-user-circle fa-2x pt-3 pull-right"></i>
                <span class="ml-2 user-text font-medium">
                            <?php $full_name = trim($identity->username); ?>
                            <?= !empty($full_name) ? $full_name : $identity->username ?>
                        </span>
                <span class="fal fa-angle-down ml-2 user-text"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                    <div>
                        <i class="fal fa-user-circle fa-4x m-2"></i>
                    </div>
                    <div class="ml-2">
                        <h4 class="mb-0"><?= $identity->username ?></h4>
                        <p class=" mb-0 text-muted"><?= $full_name ?></p>
                    </div>
                </div>

                <a href="<?= Url::to(['/profile/index']) ?>" class="dropdown-item">
                    <i class="fal fa-user icon-size"></i>
                    <?= Yii::t('app', 'Profile') ?>
                </a>

                <a class="dropdown-item" href="<?= Url::to(['/site/logout']) ?>" data-method="post"
                   title="<?= Yii::t('app', 'Logout') ?>">
                    <i class="fal fa-power-off"></i>
                    <?= Yii::t('app', 'Logout') ?>
                </a>
            </div>
        </li>
    <?php endif; ?>
    <!-- ============================================================== -->
    <!-- User profile and search -->
    <!-- ============================================================== -->
</ul>