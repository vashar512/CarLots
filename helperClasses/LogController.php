<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 5/2/16
 * Time: 11:58 AM
 */

    class LogController {
        public function __construct($REQUEST_METHOD) {
            if ($REQUEST_METHOD == 'GET') {
                 $this->get();
            }
        }

        private function get() {
            $log_attempts = new LogView();
            $log_attempts->createHtml();
            $log_attempts_page = $log_attempts->getHtml();
            echo $log_attempts_page;
        }
    }