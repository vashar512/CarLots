<?php

/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/13/16
 * Time: 11:01 AM
 */
    class User {
        public $first_name='';
        public $last_name='';
        public $email='';
        public $validated = '';

        private $password='';

        public function __construct($first = '', $last = '', $email = '', $password = '') {
            $this->setFirst($first);
            $this->setLast($last);
            $this->setEmail($email);
            if (isset($password) && $password != '') {
                $this->setPassword($password);
            }
        }

        public function setFirst($first_name) {
            $this->first_name = $first_name;
        }

        public function getFirst() {
            return $this->first_name;
        }

        public function setLast($last_name) {
            $this->last_name = $last_name;
        }

        public function getLast() {
            return $this->last_name;
        }

        public function setUid($uid) {
            $this->uid = $uid;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getEmail() {
            return $this->email;
        }

        private function setPassword($password) {
            $password_hash_class = new PasswordHash(8, false);
            $this->password = $password_hash_class->HashPassword($password);
        }


        public function saveToDatabase(PDO $db_connection = null) {
            if (isset($db_connection)) {
                if ($this->password != '') {
                    $sql = $db_connection->prepare('INSERT INTO `User` (`first`, `last`, `email`, `pass`, `validated`) VALUES (:firstName, :lastName, :email, :password, 0);');
                    $sql->bindParam(":firstName", $this->first_name);
                    $sql->bindParam(":lastName", $this->last_name);
                    $sql->bindParam(":email", $this->email);
                    $sql->bindParam(":password", $this->password);

                    $sql->execute();
                } else {
                    echo "Password was blank";
                }
            }

            echo "DB Connection is not provided.";
        }

        public function deleteFromDatabase(PDO $db_connection = null) {
            if(isset($db_connection)) {
                $sql = $db_connection->prepare("");
            }
        }
    }
?>