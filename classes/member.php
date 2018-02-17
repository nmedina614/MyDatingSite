<?php
/**
 * Member Class represents a member of the MyDatingSite Website.
 *
 * The Member class represents a member with a name, age, gender
 * phone, email, state, seeking gender, and a bio of themselves.
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


    /**
     * Member constructor.
     * @param $fname - First Name
     * @param $lname - Last Name
     * @param $age - Age
     * @param $gender - gender
     * @param $phone - Phone Number
     */
    function __construct($fname, $lname, $age, $gender, $phone) {

        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;

    }

    /**
     * Sets First Name
     * @param $fname - first name
     */
    function setFname($fname){
        $this->fname = $fname;
    }

    /**
     * Returns  First Name
     * @return mixed - Returns First Name
     */
    function getFname(){
        return $this->fname;
    }

    /**
     * Sets Last Name
     * @param $lname - Last Name
     */
    function setLname($lname){
        $this->lname = $lname;
    }

    /**
     * Returns Last Name
     * @return mixed - Return Last name
     */
    function getLname(){
        return $this->lname;
    }


    /**
     * sets the age of the Member
     * @param $age - Age of Member
     */
    function setAge($age){
        $this->age = $age;
    }

    /**
     * Returns the age of the member
     * @return mixed - returns the age of the member
     */
    function getAge(){
        return $this->age;
    }

    /**
     * sets the gender of the member
     * @param $gender - gender of the member
     */
    function setGender($gender){
        $this->gender = $gender ;
    }

    /**
     * Returns the gender
     * @return mixed - returns the gender
     */
    function getGender(){
        return $this->gender;
    }

    /**
     * sets the members Phone Number
     * @param $phone - Phone Number of Member
     */
    function setPhone($phone){
        $this->phone=$phone ;
    }

    /**
     * Returns Phone Number
     * @return mixed - returns phone number
     */
    function getPhone(){
        return $this->phone;
    }


    /**
     * Sets Email of member.
     * @param $email - Email of Member.
     */
    function setEmail($email){
        $this->email=$email;
    }


    /**
     * Return Email
     * @return mixed - Returns Email.
     */
    function getEmail(){
        return $this->email;
    }

    /**
     * Sets the State of the Member.
     * @param $state - sets the state of the member.
     */
    function setState($state){
        $this->state=$state;
    }

    /**
     * Returns the State.
     * @return mixed - Returns the state
     */
    function getState(){
        return $this->state;
    }


    /**
     * Sets the gender they are seeking.
     * @param $seeking - Gender of the member they are seeking.
     */
    function setSeeking($seeking){
        $this->seeking=$seeking;
    }

    /**
     * Returns the seeking gender.
     * @return mixed - Returns the seeking gender.
     */
    function getSeeking(){
        return $this->seeking;
    }


    /**
     * Sets the bio of member.
     * @param $bio - bio of the member.
     */
    function setBio($bio){
        $this->bio=$bio;
    }

    /**
     * Returns the bio of the user.
     * @return mixed - Returns the bio of the user.
     */
    function getBio(){
        return $this->bio;
    }



}
