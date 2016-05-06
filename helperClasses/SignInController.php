<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/24/16
 * Time: 3:26 PM
 */

    class SignInController {
        public function __construct($REQUEST_METHOD = '') {
            if ($REQUEST_METHOD != '') {
                if ($REQUEST_METHOD == 'GET') {
                    $this->getMethod();
                }

                if ($REQUEST_METHOD == 'POST') {
                    $this->postMethod();
                }
            }
        }

        function getMethod() {
            $sign_in_view = new SignInView();
            $sign_in_page = $sign_in_view->getHtml();
            echo $sign_in_page;
        }

        function postMethod() {
            $username = $_POST['user_email'];
            $pass = $_POST['user_password'];

            $db_connection = DBConnection::getConnection();
            $check_credentials = $db_connection->prepare('SELECT * FROM `User` WHERE `email`=:email');
            $check_credentials->bindParam(":email", $username);
            $check_credentials->execute();

            $user_account = $check_credentials->fetchAll();

            DBConnection::closeConnection();

            if (count($user_account) < 1) {
                $return_link = new HtmlLink("Sign In", "index.php?pageType=signIn", "");
                $logger = new Logger($username, "Failed");
                echo "No account found for the email provided. Please check your email address and try again.";
                echo "<br/>";
                echo $return_link->getLink();
                return;
            } else {
                $validated = $user_account[0]['validated'];
                if ($validated == 0) {
                    $logger = new Logger($username, "Failed");
                    $return_link = new HtmlLink("Sign In", "index.php?pageType=signIn", "");
                    echo "The email has not been validated. Please validate using the link sent from the email to sign in.";
                    echo "<br/>";
                    echo $return_link->getLink();
                    return;
                } else {
                    $user_password_hash = $user_account[0]['pass'];
                    $password_hash_class = new PasswordHash(8, false);
                    if (!$password_hash_class->CheckPassword($pass, $user_password_hash)) {
                        $logger = new Logger($username, "Failed");
                        $return_link = new HtmlLink("Sign In", "index.php?pageType=signIn", "");
                        echo "The password is incorrect. Please validate using the link sent from the email to sign in.";
                        echo "<br/>";
                        echo $return_link->getLink();
                        return;
                    } else {
                        // session_start();

                        $user = new User();
                        $user->setFirst($user_account[0]['first']);
                        $user->setLast($user_account[0]['last']);
                        $user->setEmail($username);

                        $_SESSION['logged_in_user'] = (array)$user;

                        $logout_link = new HtmlLink("Logout", "index.php?pageType=logout", "");
                        $home_link = new HtmlLink("Home", "index.php", "");
                        $add_car_link = new HtmlLink("Add Car", "index.php?pageType=addCar", "");
                        $log_attempts_link = new HtmlLink("Logs", "index.php?pageType=logAttempts", "");
                        $logger = new Logger($username, "Successful");

                        echo $logout_link->getLink();
                            echo '<br>';
                            echo '</br>';
                        echo $home_link->getLink();
                            echo '<br>';
                            echo '</br>';
                        echo $add_car_link->getLink();
                            echo '<br>';
                            echo '</br>';
                        echo $log_attempts_link->getLink();
                    }
                }
            }
        }

    }