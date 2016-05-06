<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 1:37 PM
 */

    class SignUpController {

        public function __construct($REQUEST_METHOD) {

            if ($REQUEST_METHOD == 'GET') {
                $this->get();
            } else {
                if ($REQUEST_METHOD == 'POST') {
                    $this->post();
                }
            }
        }

        private function get() {
            $sign_up_view = new SignUpView();
            $sign_up_page = $sign_up_view->getHtml();
            echo $sign_up_page;
        }

        private function post() {
            if ($_POST['username_verify'] == '') {
                $first_name = $_POST['first'];
                $last_name = $_POST['last'];
                $email = $_POST['email_address'];
                $password = $_POST['password'];

                $user = new User($first_name, $last_name, $email, $password);
                $connection = DBConnection::getConnection();
                $user->saveToDatabase($connection);
                DBConnection::closeConnection();

                $email_user = new MailUser($email);
                $response = $email_user->sendEmail();
                echo $response;

                $go_to_home_link = new HtmlLink("Home", "./index.php?pageType=home", "");
                $link = $go_to_home_link->getLink();
                echo $link;
            } else {
                $page = new Page("You are a robot. Please leave NOW!!!!!!!!");
                echo $page->getHtml();
            }
        }

    }