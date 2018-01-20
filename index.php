<?php

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();


$f3 -> set('DEBUG', 3);
//define a page1 route


$f3->route('GET /', function() {

    $template = new Template();
    echo $template -> render('pages/home.html');
}
);


$f3->run();