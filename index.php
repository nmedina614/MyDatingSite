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

$f3->route('POST /profile', function() {

    //print_r($_POST);

    //Array ( [first] => 1234 [last] => 1234 [age] => 1234 [male] => on [phone] => 1234 )

    $gender = "?";

    $_SESSION['first'] = $_POST['first'];
    $_SESSION['last'] = $_POST['first'];
    $_SESSION['age'] = $_POST['first'];

    if(isset($_POST['male'])){
        $gender = "Male";
    }
    if(isset($_POST['female'])){
        $gender = 'Female';
    }
    $_SESSION['gender'] = $gender;

    $_SESSION['phone'] = $_POST['phone'];

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