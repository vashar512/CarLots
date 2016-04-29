<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/24/16
 * Time: 7:15 PM
 */

    class LogoutController {
        public function __construct() {
            session_unset();
            session_destroy();
            header('Location: index.php');
            exit();
        }
    }

?>