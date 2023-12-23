<?php
 include 'connect.php';
//root
$tpl ='include/template/';
$langue='include/langueges/';
$func='include/function/';
$css = 'layout/css/';
$js = 'layout/js/';
$font = 'layout/font/';
$img = 'layout/img/';



?>
<?php

 include $func.'function.php';
 include $langue .'arabic.php';
 include $langue .'eng.php';
 include $tpl ."header.php";

if(!isset($nonamvbar)){ include $tpl.'navbar.php'; }



?>