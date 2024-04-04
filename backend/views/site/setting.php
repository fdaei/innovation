<?php

use sadi01\moresettings\widgets\SettingsWidget;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Settings');
?>
<div id="settings" class="site-settings">
    <div class="accordion" id="accordionSettings">
        <div class="card material-card border-info mb-3">
            <div class="card-header bg-cyan heading-CDN"
                 data-toggle="collapse"
                 data-target="#collapse-CDN"
                 aria-expanded="false"
                 aria-controls="collapse-CDN">
                <div class="text-left text-white text-bold">
                    <?= Yii::t('app', 'CDN') ?>
                </div>
            </div>
            <div id="collapse-CDN" class="collapse card-body bg-light"
                 aria-labelledby="heading-CDN" data-parent="#accordionSettings">

                <?= SettingsWidget::widget([
                    'categoryName' => 'base',
                    'settingName' => 'cdnClientID',
                ]) ?>

                <?= SettingsWidget::widget([
                    'categoryName' => 'base',
                    'settingName' => 'cdnClientSecret',
                ]) ?>
            </div>
        </div>
    </div>
</div>