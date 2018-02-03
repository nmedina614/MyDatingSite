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

    $_SESSION['first'] = $_POST['email'];
    $_SESSION['last'] = $_POST['state'];
    $_SESSION['age'] = $_POST['gender'];
    $_SESSION['gender'] = $_POST['bio'];


    $template = new Template();
    echo $template->render('pages/interests.html');

}
);


$f3->route('POST /summary', function() {


    //print_r($_POST);
    //Array ( [indoor] => Array ( [0] => tv [1] => movies [2] => cooking [3] => board games [4] => puzzles [5] => reading [6] => playing cards [7] => video games )
    // [outdoor] => Array ( [0] => Hiking [1] => Biking [2] => Swimming [3] => collecting [4] => walking [5] => climbing [6] => sports ) )

    $_SESSION['indoor'] = $_POST['indoor'];
    $_SESSION['outdoor'] = $_POST['outdoor'];

    $template = new Template();
    echo $template->render('pages/summary.html');

}
);



$f3->run();