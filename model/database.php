<?php

require('/home/nmedinag/config/config.php');

/**
 * Class Database represents the database PDO object and its methods for MyDatingWebsite
 * Allows the user to connect to the database and insert a new member
 * when created into the database
 *
 *
 *
 * Create table Statement, I had help from the Create Table thing in phpmyadmin because
 * I also have trouble with some values, I also worked with my Partner for the final
 * Arron on choosing the Datatype because im not the best at that either.
 *
 * CREATE TABLE `nmedinag_grc`.`members`
 * ( `member_id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(30) NOT NULL ,
 * `lname` VARCHAR(30) NOT NULL , `age` INT NOT NULL , `gender` CHAR(1) NOT NULL ,
 * `phone` VARCHAR(12) NOT NULL , `email` VARCHAR(60) NOT NULL , `state` CHAR(2) NOT NULL ,
 * `seeking` CHAR(1) NOT NULL , `bio` TEXT NOT NULL , `premium` TINYINT NOT NULL ,
 * `image` TEXT NULL , `interests` TEXT NULL , PRIMARY KEY (`member_id`)) ENGINE = MyISAM;
 *
 *
 * @author Nolan Medina
 * @copyright 2018
 */
class Database
{
    //Private Static variable to hold PDO object
    private static $_dbh;


    /**
     * Connect to the database function
     */
    public static function connect() {
        try {
            // instantiate pdo object.
            self::$_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * sumbit member function to be used to add a new member into the
     * database
     *
     * @param $fname - first name
     * @param $lname - last name
     * @param $age - age
     * @param $gender - gender
     * @param $phone - phone number
     * @param $email - email
     * @param $state - state
     * @param $seeking - seeking
     * @param $bio - bio
     * @param $premium - premium (tinyint in database, either 0 or 1)
     * @param $image - image path, not used so always null
     * @param $interests - interests of member.
     */
    public static function submitMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking
                            ,$bio, $premium, $image, $interests) {



        //define query
        $sql = "INSERT INTO `members` (`fname`, `lname`, `age`, `gender`, `phone`, `email`, `state`, 
                `seeking`, `bio`, `premium`, `image`, `interests`) VALUES 
                (:fname, :lname, :age, :gender, :phone, :email, 
                :state, :seeking, :bio, :premium, :image, :interests); ";

        //Prepare the statement
        $statement = self::$_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        $statement ->execute();

    }

    /**
     * Pulls all the members in the database.
     * @return mixed - Array of all the members
     */
    public static function pullMembers(){

        $sql = "SELECT * FROM members ORDER BY lname";
        //2. prepare the statement
        $statement = self::$_dbh->prepare($sql);
        //3. bind parameters
        //4. execute the statement
        $statement->execute();
        //5. return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);
        return $result;
    }


}