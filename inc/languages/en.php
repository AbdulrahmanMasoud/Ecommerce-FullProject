<?php

function lang($phrase){
static $lang = array(
    'search' => 'Search',
    'show_more' => 'Show More',
    'login' => 'Login',
    'username' => 'UserName',
    'password' => 'Password',
    're_password' => 'Re-Password',
    'remember' => 'Remember Me',
    'register' => 'Register',
    'name' => 'Name',
    'email' => 'Email',
    'male' => 'Male',
    'female' => 'Female',

    //
    'home' => 'Home',
    'shop' => 'Shop',
    'about' => 'About Us',
    'contact' => 'Contact',
    'faq' => 'FAQ',
    //
    'labtop' => 'Labtop',
    'smart_phone' => 'Smart Phone',
    'camera' => 'Camera',
    'accessories' => 'Accessories',
);
return $lang[$phrase];
}

?>