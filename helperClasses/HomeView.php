<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 1:02 PM
 */

    class HomeView extends Page {

        public function __construct() {

            $sign_up_link = new HtmlLink("Sign Up", "index.php?pageType=signUp", "");
            $sign_in_link = new HtmlLink("Sign In", "index.php?pageType=signIn", "");
            $view_cars_link = new HtmlLink("View Cars", "index.php?pageType=viewCars", "");

            $this->html = $sign_in_link->getLink();
            $this->html .= '<br/>';
            $this->html .= $sign_up_link->getLink();
            $this->html .= '<br/>';
            $this->html .= $view_cars_link->getLink();

            if (isset($_SESSION['logged_in_user'])) {
                $log_attempts_link = new HtmlLink("Logs", "index.php?pageType=logAttempts", "");

                $this->html .= '<br/>';
                $this->html .= $log_attempts_link->getLink();
            }
        }

    }

?>