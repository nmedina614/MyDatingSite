<?php
/**
 * Premium Member Class represents a member of the MyDatingSite Website.
 *
 * The Member class represents a member with a name, age, gender
 * phone, email, state, seeking gender, and a bio of themselves, and
 * the interests of the user.
 *
 * @author Nolan Medina
 * @copyright 2018
 */

class PremiumMember extends Member
{

    private $inDoorInterests = array();
    private $outDoorInterests = array();


    /**
     * Sets the Intersts for indoor Activities
     * @param $array - Indoor interests array.
     */
    function setIndoor($array){

        foreach ($array as $value) {

            array_push($this->inDoorInterests, $value);

        }

    }

    /**
     * Returns the Indoor array
     * @return array - Returns the indoor array
     */
    function getIndoor(){

        return $this->inDoorInterests;

    }

    /**
     * Sets the Intersts for Outdoor Activities
     * @param $array - outdoor interests array.
     */
    function setOutdoor($array){

        foreach ($array as $value) {

            array_push($this->outDoorInterests, $value);

        }

    }


    /**
     * Returns the outdoor array
     * @return array - Returns the outdoor array
     */
    function getOutdoor(){

        return $this->outDoorInterests;

    }


}