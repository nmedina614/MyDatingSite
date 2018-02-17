<?php
/**
 * Created by PhpStorm.
 * User: njmed
 * Date: 2/16/2018
 * Time: 3:11 PM
 */

class PremiumMember extends Member
{

    private $inDoorInterests = array();
    private $outDoorInterests = array();


    function setIndoor($array){

        foreach ($array as $value) {

            array_push($this->inDoorInterests, $value);

        }

    }


    function getIndoor(){

        return $this->inDoorInterests;

    }

    function setOutdoor($array){

        foreach ($array as $value) {

            array_push($this->outDoorInterests, $value);

        }

    }

    function getOutdoor(){

        return $this->outDoorInterests;

    }


}