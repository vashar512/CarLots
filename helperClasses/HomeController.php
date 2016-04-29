<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 11:50 AM
 */

    class HomeController {

        public function __construct($REQUEST_METHOD) {
            if ($REQUEST_METHOD == 'GET') {
                $this->getMethod();
            }

        }

        private function getMethod() {
            $home_view = new HomeView();
            $home_page = $home_view->getHtml();
            echo $home_page;

            if (isset($_SESSION['logged_in_user'])) {
                $user_login_status = $_SESSION['logged_in_user'];
            } else {
                $user_login_status = '';
            }

            if ($user_login_status != '') {
                $logout_link = new HtmlLink("Logout", "index.php?pageType=logout", "");
                echo $logout_link->getLink();
            }
        }

    }

?>
