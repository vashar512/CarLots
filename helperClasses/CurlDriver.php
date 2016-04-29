<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 10:54 AM
 */

    class CurlDriver {

        public $curl = null;

        public function __construct($url = null) {
            $this->initializeCurl($url);
        }

        public function initializeCurl($url) {
            /**
             * Initialize curl.
             */
            $this->curl = curl_init();


            if (!$url == null && !$url == "") {
                curl_setopt($this->curl, CURLOPT_URL, $url);
            }

            /**
             * Set option to return response as string.
             */
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        }

        public function setUrl($url) {
            curl_setopt($this->curl, CURLOPT_URL, $url);
        }

        public function sendCurlRequest() {
            $response = curl_exec($this->curl);
            return $response;
        }

        public function closeCurlConnection() {
            curl_close($this->curl);
        }
    }

?>