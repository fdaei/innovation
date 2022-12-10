<?php

use common\components\Menu;

$menu_items = [];
$menu_items = [
    [
        'group' => 'site',
        'label' => 'سایت',
        'icon' => 'fas fa-desktop-alt',
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'Business',
                'label' => Yii::t('app', 'Business'),
                'icon' => 'fas fa-building',
                'url' => ['/business']
            ],
            [
                'group' => 'City',
                'label' => Yii::t('app', 'City'),
                'icon' => 'fas fa-building',
                'url' => ['/city/']
            ],
            [
                'group' => 'Province',
                'label' => Yii::t('app', 'Province'),
                'icon' => 'fas fa-building',
                'url' => ['/province/']
            ],
            [
                'group' => 'CareerApply',
                'label' => Yii::t('app', 'CareerApply'),
                'icon' => 'fas fa-building',
                'url' => ['/career-apply/']
            ],
            [
                'group' => 'JobPosition',
                'label' => Yii::t('app', 'JobPosition'),
                'icon' => 'fas fa-building',
                'url' => ['/job-position/']
            ],
            [
                'group' => 'OrgUnit',
                'label' => Yii::t('app', 'OrgUnit'),
                'icon' => 'fas fa-building',
                'url' => ['/org-unit/']
            ],
        ],
    ]
];
?>
    <aside class="left-sidebar">
        <div class="mb-2">
            <input class="form-control rounded-0" type='text' id='search' placeholder='جستجو...'>
        </div>
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