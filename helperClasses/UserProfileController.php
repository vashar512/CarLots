<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/29/16
 * Time: 3:16 PM
 */

    class UserProfileController {
        public function __construct($REQUEST_METHOD) {
            if ($REQUEST_METHOD == 'GET') {
                $this->getMethod();
            }
        }

        private function getMethod() {
            $email = $_GET['email'];

            $db_connection = DBConnection::getConnection();
            $get_user = $db_connection->prepare('SELECT `first`, `last`, `email` FROM `User` WHERE `email`=:email');
            $get_user->bindParam(":email", $email);
            try {
                $get_user->execute();

                $user_array = $get_user->fetch(PDO::FETCH_ASSOC);

                DBConnection::closeConnection();

                $user = new User($user_array['first'], $user_array['last'], $user_array['email'], '');

                $view_user_profile = new UserProfileView($user);
                $user_profile_page = $view_user_profile->getHtml();
                echo $user_profile_page;
            } catch (PDOException $e) {
                $error_page = new Page($e->getMessage());
                echo $error_page->getHtml();
            }
        }
    }