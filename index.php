<?php

session_start();

    $errors=array('test');
    $indoor=array('tv', 'movies','cooking','board games', 'puzzles', 'reading',
    'playing cards', 'video games');
    $outdoor=array('Hiking', 'Biking','Swimming','collecting', 'walking', 'climbing',
    'sports');


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


$f3->route('GET|POST /personal', function($f3, $errors) {

    /*print_r($_POST);*/

    if(isset($_POST['submit'])) {

        include('model/valid.php');

        if (validName($_POST['first'], $_POST['last'])) {
            $_SESSION['first'] = $_POST['first'];
            $_SESSION['last'] = $_POST['last'];
        } else {
            array_push($errors, "name");
        }

        if (validAge($_POST['age'])) {
            $_SESSION['age'] = $_POST['age'];
        } else {
            array_push($errors, "age");
        }

        if (validPhone($_POST['phone'])) {
            $_SESSION['phone'] = $_POST['phone'];
        } else {
            array_push($errors, 'phone');
        }

        $_SESSION['gender'] = $_POST['gender'];

        if (!in_array('name', $errors) && !in_array('age', $errors)
            && !in_array('phone', $errors)) {

            $f3->reroute('/profile');

        }

        if (in_array('name', $errors)) {
            $f3->set('name', "There is a error in entering your name please try again");
        }
        if (in_array('age', $errors)) {
            $f3->set('age', "There is a error in entering your Age Please enter an age over 18");
        }
        if (in_array('phone', $errors)) {
            $f3->set('phone', "There is a error in entering your Phone Number please try again");
        }

    }
    $template = new Template();
    echo $template->render('pages/personal-info.html');

}
);

$f3->route('GET|POST /profile', function($f3)  {

    if(isset($_POST['submit'])){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['gender'];
        $_SESSION['bio'] = $_POST['bio'];
        $f3->reroute('/interests');
    }


    $template = new Template();
    echo $template->render('pages/profile.html');

}
);

$f3->route('GET|POST /interests', function($f3, $indoor, $outdoor) {

    if(isset($_POST['submit'])) {


        $_SESSION['indoor'] = $_POST['indoor'];
        $_SESSION['outdoor'] = $_POST['outdoor'];

        foreach($_SESSION['indoor'] as $key=>$value)
        {
            if(!validIndoor($value, $indoor)){;
                array_push($errors, 'indoor');
                break;
            }
        }

        foreach($_SESSION['outdoor'] as $key=>$value)
        {
            if(validOutdoor($value, $outdoor)){
                array_push($errors, 'indoor');
                break;
            }
        }

        if (!in_array('indoor', $errors) && !in_array('outdoor', $errors)) {

            $f3->reroute('/summary');

        }

        if (in_array('name', $errors)) {
            $f3->set('indoor', "There is a error in choosing your indoor interests please try again");
        }
        if (in_array('age', $errors)) {
            $f3->set('age', "There is a error in choosing your outdoor interests
             Please try again");
        }


    }


    $template = new Template();
    echo $template->render('pages/interests.html');

}
);


$f3->route('GET|POST /summary', function($f3) {

    if(isset($_SESSION['indoor'])){
        echo "it is set";
    }

    //print_r($_POST);
    //Array ( [indoor] => Array ( [0] => tv [1] => movies [2] => cooking [3] => board games [4] => puzzles [5] => reading [6] => playing cards [7] => video games )
    // [outdoor] => Array ( [0] => Hiking [1] => Biking [2] => Swimming [3] => collecting [4] => walking [5] => climbing [6] => sports ) )

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

    //I encountered an Error Here and couldn't figure out a solution. If you see what is wrong please
    //send me a message. I think it has something to do with the session not getting stored but i don't
    //know why that would be.

       /*foreach($_SESSION['indoor'] as $key=>$value)
       {
               $f3->push('indoor', $value);
        }


       foreach($_SESSION['outdoor'] as $key=>$value)
       {
           // and print out the values
           $f3->push('indoor', $value);
       }*/

    $template = new Template();
    echo $template->render('pages/summary.html');

}
);



$f3->run();