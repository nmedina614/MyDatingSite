<?php

session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();


$f3 -> set('DEBUG', 3);



$f3->route('GET /', function() {

    $template = new Template();
    echo $template->render('pages/home.html');

}
);


$f3->route('GET /personal', function() {

    $template = new Template();
    echo $template->render('pages/personal-info.html');

}
);

$f3->route('GET /profile', function() {

    $template = new Template();
    echo $template->render('pages/profile.html');

}
);

$f3->route('GET /interests', function() {

    $template = new Template();
    echo $template->render('pages/interests.html');

}
);


$f3->route('GET /summary', function() {

    $template = new Template();
    echo $template->render('pages/summary.html');

}
);



$f3->run();