<?php
include 'conect.php';
$tpl = 'inc/templates/'; // templates directory
$css = 'layout/css/'; // css directory
$js = 'layout/js/'; // js directory
$fonts = 'layout/fonts/'; // fonts directory
$lang = 'inc/languages/';
$func = 'inc/functions/';



// Important Files
include $func . 'functions.php';
include  $lang . 'en.php'; 
include  $tpl . 'header.php'; 
 

if(!isset($no_navbar)){
    include  $tpl . 'navbar.php';
}


?>