<?php

use common\components\Menu;

$menu_items = [];
$menu_items = [
    [
        'group' => 'Dashboard',
        'label' => 'داشبورد ',
        'icon' => 'fas fa-tachometer-alt', // ایکون داشبورد
        'url' => ['/dashboard']
    ],
    [
        'group' => 'Secretariat',
        'label' => ' واحد دبیرخانه',
        'icon' => 'fas fa-envelope-open-text', // ایکون دبیرخانه
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'contact',
                'label' => 'مخاطبین',
                'icon' => 'fas fa-address-book', // ایکون مخاطبین
                'url' => ['/city/']
            ],
            [
                'group' => 'archive',
                'label' => 'بایگانی ',
                'icon' => 'fas fa-archive', // ایکون بایگانی
                'url' => ['/archive']
            ],
            [
                'group' => 'letters',
                'label' => 'نامه ها ',
                'icon' => 'fas fa-mail-bulk', // ایکون نامه‌ها
                'url' => ['/letters']
            ],
        ]
    ],
    [
        'group' => 'Business',
        'label' => 'واحد بازرگانی ',
        'icon' => 'fas fa-store', // ایکون بازرگانی
        'level' => "first-level",
        'encode' => false,
        'items' => [
            [
                'group' => 'Buy',
                'label' => ' واحد خرید',
                'icon' => 'fas fa-shopping-cart', // ایکون خرید
                'url' => ['/career-apply/']
            ],
            [
                'group' => 'Sell',
                'label' => 'واحد فروش',
                'icon' => 'fas fa-cash-register', // ایکون فروش
                'url' => ['/job-position/']
            ],
        ]
    ],
    [
        'group' => 'base',
        'label' => 'اطلاعات پایه ',
        'icon' => 'fas fa-database', // ایکون اطلاعات پایه
        'url' => ['/dashboard']
    ],
    [
        'group' => 'setting',
        'label' => 'تنظیمات  ',
        'icon' => 'fas fa-cogs', // ایکون تنظیمات
        'url' => ['/dashboard']
    ],
];

?>
    <aside class="left-sidebar">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">

                <?= Menu::widget(
                    [
                        'options' => ['id' => 'sidebarnav'],
                        'itemOptions' => ['class' => 'sidebar-item'],
                        'items' => $menu_items,
                    ]
                ) ?>
            </nav>
        </div>
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