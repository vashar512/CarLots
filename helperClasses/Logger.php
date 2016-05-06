<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 5/2/16
 * Time: 4:47 AM
 */

    class Logger {
        public function __construct($username, $status) {
            if ($username != '') {
                $db_connection = DBConnection::getConnection();
                $log_attempt = $db_connection->prepare("INSERT INTO `Logs` (`Username`, `AccessDateTime`, `Status`)
                VALUES (:username, NOW(), :status)");
                $log_attempt->bindParam(":username", $username);
                $log_attempt->bindParam(":status", $status);
                $log_attempt->execute();

                DBConnection::closeConnection();
            } else {
                echo 'Username Empty.';
            }
        }
    }
?>