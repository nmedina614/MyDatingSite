<?php

session_start();

/*<!--

Author: Nolan Medina
File: index.php
Last Edited: 2/2/18

-->*/

    $errors=array('test');


//Require the autoload file
require_once('vendor/autoload.php');
require('model/valid.php');

//Create an instance of the Base Class
$f3 = Base::instance();


$f3 -> set('DEBUG', 3);



$f3->route('GET /', function() {

    $template = new Template();
    echo $template->render('pages/home.html');

}
);


$f3->route('GET|POST /personal', function($f3, $errors) {


    if(isset($_POST['submit'])) {


        $f3->set('first',$_POST['first']);
        $f3->set('last',$_POST['last']);
        $f3->set('ageStick',$_POST['age']);
        $f3->set('phoneStick',$_POST['phone']);
        if($_POST['gender']=='male'){
            $f3->set('checkedMale',$_POST['gender']);
        } elseif($_POST['gender']=='female'){
            $f3->set('checkedFemale',$_POST['gender']);
        }


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


            //Sets User Object to premium or not Premium, used for interests
            if(isset($_POST['premium'])) {
                $_SESSION['premium'] = 'yes';
                $user = new PremiumMember($_SESSION['first'], $_SESSION['last'], $_SESSION['age'], $_SESSION['gender'], $_SESSION['phone']);
            } else{
                $_SESSION['premium'] = 'no';
                $user = new Member($_SESSION['first'], $_SESSION['last'], $_SESSION['age'], $_SESSION['gender'], $_SESSION['phone']);
            }

            //NOTE: This was the way I was able to pass via sessions, if i tried to do
            //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
            //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
            //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
            $user1 = serialize($user);
            $fp = fopen("store", "w");
            fwrite($fp, $user1);
            fclose($fp);

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

        //NOTE: This was the way I was able to pass via sessions, if i tried to do
        //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
        //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
        //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
        $user1 = implode("", @file("store"));
        $user = unserialize($user1);

        //Sets user objects variables
        $user->setEmail($_POST['email']);
        $user->setState($_POST['state']);
        $user->setSeeking($_POST['gender']);
        $user->setBio($_POST['bio']);


        //NOTE: This was the way I was able to pass via sessions, if i tried to do
        //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
        //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
        //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
        $user1 = serialize($user);
        $fp = fopen("store", "w");
        fwrite($fp, $user1);
        fclose($fp);


        //Redirects based on premium status
        if(($_SESSION['premium']) == 'yes'){
            $f3->reroute('/interests');
        } else{
            $f3->reroute('/summary');
        }


    }


    $template = new Template();
    echo $template->render('pages/profile.html');

}
);

$f3->route('GET|POST /interests', function($f3,  $errors) {

    $indoor=array('tv', 'movies','cooking','board games', 'puzzles', 'reading',
        'playing cards', 'video games');
    $outdoor=array('Hiking', 'Biking','Swimming','collecting', 'walking', 'climbing',
        'sports');


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
            if(!validOutdoor($value, $outdoor)){
                array_push($errors, 'outdoor');
                break;
            }
        }

        if (!in_array('indoor', $errors) && !in_array('outdoor', $errors)) {

            //NOTE: This was the way I was able to pass via sessions, if i tried to do
            //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
            //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
            //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
            $user1 = implode("", @file("store"));
            $user = unserialize($user1);

            //Sets user objects variables
            $user->setIndoor($_SESSION['indoor']);
            $user->setOutdoor($_SESSION['outdoor']);


            //NOTE: This was the way I was able to pass via sessions, if i tried to do
            //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
            //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
            //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
            $user1 = serialize($user);
            $fp = fopen("store", "w");
            fwrite($fp, $user1);
            fclose($fp);


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

    //NOTE: This was the way I was able to pass via sessions, if i tried to do
    //$_SESSION['user'] = $user; i would encouter a __PHP_Incomplete_Class_Name, and looking it up
    //documentation required me to use the serialize method rather then doing the $_SESSION stuff.
    //So i used the code from http://php.net/manual/it/oop4.serialization.php as a base
    $user1 = implode("", @file("store"));
    $user = unserialize($user1);


    //Sets user variables to F3 to be used on html
    $f3->set('first',$user->getFname());
    $f3->set('last',$user->getLname());
    $f3->set('age',$user->getAge());
    $f3->set('gender',$user->getGender());
    $f3->set('phone',$user->getPhone());

    $f3->set('email',$user->getEmail());
    $f3->set('state',$user->getState());
    $f3->set('seeking',$user->getSeeking());
    $f3->set('bio',$user->getBio());

    if(isset($_SESSION['indoor']) && $_SESSION['premium']=='yes'){

        $f3->set('indoor',$user->getIndoor());
        $f3->set('premium', true);

    }

    if(isset($_SESSION['outdoor']) && $_SESSION['premium']=='yes'){

        $f3->set('outdoor',$user->getOutdoor());
        $f3->set('premium', true);

    }



    $template = new Template();
    echo $template->render('pages/summary.html');

}
);



$f3->run();