<?php
/**
 *
 * Member Class
 *
 * @author Nolan Medina
 * @copyright 2018
 */

class Member
{

    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    function __construct($fname, $lname, $age, $gender, $phone) {

        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;

    }

    function setFname($fname){
        $this->fname = $fname;
    }

    function getFname(){
        return $this->fname;
    }

    function setLname($lname){
        $this->lname = $lname;
    }

    function getLname(){
        return $this->lname;
    }

    function setAge($age){
        $this->age = $age;
    }

    function getAge(){
        return $this->age;
    }

    function setGender($gender){
        $this->gender = $gender ;
    }

    function getGender(){
        return $this->gender;
    }

    function setPhone($phone){
        $this->phone=$phone ;
    }

    function getPhone(){
        return $this->phone;
    }

    function setEmail($email){
        $this->email=$email;
    }

    function getEmail(){
        return $this->email;
    }

    function setState($state){
        $this->state=$state ;
    }

    function getState(){
        return $this->state;
    }

    function setSeeking($seeking){
        $this->seeking=$seeking;
    }

    function getSeeking(){
        return $this->seeking;
    }

    function setBio($bio){
        $this->bio=$bio;
    }

    function getBio(){
        return $this->bio;
    }



}
