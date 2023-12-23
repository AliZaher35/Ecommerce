<?php

function lang( $word )
{
 static $lang =
  [  
    //dashboard words
    'Home'   =>'HOME',
    'Categories'=>'Categories',
   'Items' => 'Items', 
   'Members' => 'Members', 
   'Statistisc' => 'Statistisc', 
   'Logs' => 'Logs', 
   'Edit Profile' => 'Edit Profile', 
 
 
  ];

return $lang[$word];
}



?>