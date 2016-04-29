<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 11:06 AM
 */

    abstract class Database {

        private $server_credentials_file_path = '../server_creds.txt';

        protected $username = '';
        protected $pass = '';
        protected $host_name = '';

        private function __construct() {
            $server_credentials = file_get_contents($this->server_credentials_file_path);

            $file_contents_array = explode(PHP_EOL, $server_credentials);

            $this->username = $file_contents_array[0];
            $this->pass = $file_contents_array[1];
            $this->host_name = $file_contents_array[2];
        }
    }

?>