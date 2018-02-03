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

    //Array ( [first] => Testing123 [last] => Testing123 [age] => Testing123 [gender] => male [phone] => Test123 )

    $_SESSION['first'] = $_POST['first'];
    $_SESSION['last'] = $_POST['last'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];

    $template = new Template();
    echo $template->render('pages/profile.html');

}
);

$f3->route('POST /interests', function() {

    //print_r($_POST);

    //Array ( [email] => jnjeoijoiqj3lknas [state] => WA [gender] => male [bio] => fewfwefwefwef )

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['gender'];
    $_SESSION['bio'] = $_POST['bio'];


    $template = new Template();
    echo $template->render('pages/interests.html');

}
);


$f3->route('POST /summary', function($f3) {


    //print_r($_POST);
    //Array ( [indoor] => Array ( [0] => tv [1] => movies [2] => cooking [3] => board games [4] => puzzles [5] => reading [6] => playing cards [7] => video games )
    // [outdoor] => Array ( [0] => Hiking [1] => Biking [2] => Swimming [3] => collecting [4] => walking [5] => climbing [6] => sports ) )

    $_SESSION['indoor'] = $_POST['indoor'];
    $_SESSION['outdoor'] = $_POST['outdoor'];



    $f3->set('first',$_SESSION['first']);
    $f3->set('last',$_SESSION['last']);
    $f3->set('age',$_SESSION['age']);
    $f3->set('gender',$_SESSION['gender']);
    $f3->set('phone',$_SESSION['phone']);

    $f3->set('email',$_SESSION['email']);
    $f3->set('state',$_SESSION['state']);
    $f3->set('seeking',$_SESSION['seeking']);
    $f3->set('bio',$_SESSION['bio']);

    $f3->set('indoor', array());
    $f3->set('outdoor',array());

    foreach($_SESSION['indoor'] as $key=>$value)
    {
        // and print out the values
        $f3->push('indoor', $value);
    }

    foreach($_SESSION['outdoor'] as $key=>$value)
    {
        // and print out the values
        $f3->push('indoor', $value);
    }

    $template = new Template();
    echo $template->render('pages/summary.html');

}
);



$f3->run();