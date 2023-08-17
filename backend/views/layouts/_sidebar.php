<?php

use common\components\Menu;

$menu_items = [];
$menu_items = [
    [
        'group' => 'Business',
        'label' => Yii::t('app', 'Business'),
        'icon' => 'fas fa-briefcase',
        'url' => ['/businesses']
    ],
    [
        'group' => 'location',
        'label' => 'موقعیت مکانی',
        'icon' => 'fas fa-map-marked-alt',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'City',
                'label' => Yii::t('app', 'City'),
                'icon' => 'fas fa-city',
                'url' => ['/city/']
            ],
            [
                'group' => 'Province',
                'label' => Yii::t('app', 'Province'),
                'icon' => 'fas fa-map',
                'url' => ['/province/']
            ],
        ]
    ],
    [
        'group' => 'CareerApply',
        'label' => 'موقعیت شغلی',
        'icon' => 'fas fa-briefcase',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'CareerApply',
                'label' => Yii::t('app', 'CareerApply'),
                'icon' => 'fas fa-clipboard-check',
                'url' => ['/career-apply/']
            ],
            [
                'group' => 'JobPosition',
                'label' => Yii::t('app', 'JobPosition'),
                'icon' => 'fas fa-user-tie',
                'url' => ['/job-position/']
            ],
            [
                'group' => 'OrgUnit',
                'label' => Yii::t('app', 'OrgUnit'),
                'icon' => 'fas fa-sitemap',
                'url' => ['/org-unit/']
            ],
        ]
    ],
    [
        'group' => 'Mentor',
        'label' => 'مشاوره',
        'icon' => 'fas fa-chalkboard-teacher',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'Mentor',
                'label' => 'مشاوران',
                'icon' => 'fas fa-users',
                'url' => ['/mentor/']
            ],
            [
                'group' => 'Mentor',
                'label' => Yii::t('app', 'mentors-advice-request'),
                'icon' => 'fas fa-comments',
                'url' => ['/mentors-advice-request/']
            ],
            [
                'group' => 'Mentor',
                'label' => Yii::t('app', 'Mentor Category'),
                'icon' => 'fas fa-list',
                'url' => ['/mentor-category/']
            ],

        ]
    ],
    [
        'group' => 'Events',
        'label' => 'رویداد',
        'icon' => 'fas fa-calendar-alt',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'Events',
                'label' => Yii::t('app', 'Events'),
                'icon' => 'fas fa-calendar-check',
                'url' => ['/event/']
            ],
            [
                'group' => 'event-teachers',
                'label' => 'برگذار کنندگان',
                'icon' => 'fas fa-users',
                'url' => ['event-organizer/']
            ],
            [
                'group' => 'EventHall',
                'label' => Yii::t('app', 'EventHall'),
                'icon' => 'fas fa-building',
                'url' => ['/event-hall/']
            ]
        ]
    ],
    [
        'group' => 'Activity',
        'label' => Yii::t('app', 'Activity'),
        'icon' => 'fas fa-chart-line',
        'url' => ['/activity/']
    ],
    [
        'group' => 'Tags',
        'label' => Yii::t('app', 'Tags'),
        'icon' => 'fas fa-tags',
        'url' => ['/tag/index']
    ],
    [
        'group' => 'Branches',
        'label' => Yii::t('app', 'Branches'),
        'icon' => 'fas fa-code-branch',
        'url' => ['/branches/']
    ],
    [
        'group' => 'Notification',
        'label' => Yii::t('app', 'Notification'),
        'icon' => 'fas fa-bell',
        'url' => ['/notification/']
    ],
    [
        'group' => 'freelancer',
        'label' => Yii::t('app', 'Freelancer'),
        'icon' => 'fas fa-user-friends',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'freelancer',
                'label' => Yii::t('app', 'Freelancers'),
                'icon' => 'fas fa-users',
                'url' => ['/freelancer/'],
            ],
            [
                'group' => 'freelancer',
                'label' => Yii::t('app', 'Freelancer Categrory'),
                'icon' => 'fas fa-check-square',
                'url' => ['/freelancer-category-list/']
            ],
        ]
    ],
    [
        'group' => 'hitech',
        'label' => 'هایتک',
        'icon' => 'fas fa-rocket',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'hitech',
                'label' => Yii::t('app', 'Hitech'),
                'icon' => 'fas fa-check-square',
                'url' => ['/hitech/']
            ],
            [
                'group' => 'hitech',
                'label' => Yii::t('app', 'Hitech Proposal'),
                'icon' => 'fas fa-file-alt',
                'url' => ['/hitech-proposal/']
            ],
        ]
    ],
    [
        'group' => 'log',
        'label' => Yii::t('app', 'Logs'),
        'icon' => 'fas fa-file-alt',
        'url' => ['/log/']
    ],
    [
        'group' => 'swagger',
        'label' => 'مستندات API',
        'icon' => 'fas fa-file-code',
        'url' => ['/swagger'],
        'encode' => false,
        'template' => '<a class="sidebar-link" href="{url}" target="_blank">{icon} {label}</a>',
    ],
    [
        'group' => 'Settings',
        'label' => 'تنظیمات',
        'icon' => 'fas fa-cogs',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'Settings',
                'label' => Yii::t('app', 'Manage Settings'),
                'icon' => 'fas fa-cog',
                'url' => ['/moresettings/default/index']
            ],
            [
                'group' => 'Settings',
                'label' => Yii::t('app', 'Settings'),
                'icon' => 'fas fa-cog',
                'url' => ['/site/setting']
            ],
        ]
    ],
];

?>
    <aside class="left-sidebar">

        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">

                <?= Menu::widget(
                    [
                        'options' => ['id' => 'sidebarnav'],
                        'itemOptions' => ['class' => 'sidebar-item'],
                        'items' => $menu_items,
                    ]
                ) ?>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>

<?php
$script = <<<JS
$.extend($.expr[":"], {
"containsIN": function(elem, i, match, array) {
return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
}
});

 $('#search').keyup(function(){
     // Search text
  var text = $(this).val();
 
  // Hide all content class element
  $('.sidebar-item').hide();
  $('.devider').hide(); 

  var sidebar_item_contains_text = $('.sidebar-item:containsIN("'+text+'")');
  // Search and show
  //show sidebar item contains text + nex div.devider
  sidebar_item_contains_text.show().next('.devider').show();
  
  sidebar_item_contains_text.parent().addClass('in');
  
  sidebar_item_contains_text.parent().prev().addClass('active');

    if(text.length === 0){
          $("#sidebarnav ul").removeClass('in');
          $("#sidebarnav a").removeClass('active');
    }
 });
JS;
$this->registerJs($script);