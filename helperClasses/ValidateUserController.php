<?php
/**
 * Created by PhpStorm.
 * Date: 4/24/16
 * Time: 1:25 PM
 */

    class ValidateUserController {
        public static function validateUser($user_email = '') {
            if ($user_email == '') {
                echo "Sorry, no email address provided. Cannot fullfill the requested operation please.";
                return;
            }

            $dbConnection = DBConnection::getConnection();
            if ($dbConnection != null) {
                $query = 'UPDATE `User` SET `validated`=1 WHERE `email`=:email';
                $validate_query = $dbConnection->prepare($query);
                $validate_query->bindParam(":email", $user_email);
                $validate_query->execute();

                if ($validate_query->rowCount() == 0) {
                    DBConnection::closeConnection();
                    echo "Account could not be validated. Please contact Customer Service.";
                    return;
                }

                DBConnection::closeConnection();
                echo "Successfully validated user. Welcome to the family.";
                return;
            }

            echo "Sorry, database connection cannot be setup right now. Please try again later. Sorry for the inconvenience";
            return;
        }
    }

?>