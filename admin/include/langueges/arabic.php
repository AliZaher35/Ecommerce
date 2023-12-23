<?php

function langa( $word)
{
 static $langa =
  [  
    //dashboard words
    'Home'   =>'الرئيسية',
    'Categories'=>'الفئات',
   'Items' => 'العناصر', 
   'Members' => 'الأعضاء', 
   'Statistisc' => 'الاحصائيات', 
   'Logs' => 'السجلات', 
   'Send Message' => 'أرسل رسالة' 
 
 
  ];

return $langa[$word];
}




?>