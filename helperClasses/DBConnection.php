<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 11:22 AM
 *
 * Want to make sure the database does the most work because it is much faster than the program and it stores the
 * actual data.
 */

    class DBConnection {

        private $server_credentials_file_path = './server_creds.txt';

        private $username = '';
        private $pass = '';
        private $host_name = '';

        private static $connection;

        private function __construct() {
            $server_credential_contents = file_get_contents($this->server_credentials_file_path);

            $file_contents_array = explode(PHP_EOL, $server_credential_contents);

            $this->username = $file_contents_array[0];
            $this->pass = $file_contents_array[1];
            $this->host_name = $file_contents_array[2];

            try {
                $dsn = "mysql:host=$this->host_name;dbname=vha6";

                self::$connection = new PDO($dsn, $this->username, $this->pass);

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $pdoException) {
                echo 'Could not connect' . $pdoException->getMessage();
            }
        }

        public static function getConnection() {
            if (!self::$connection) {
                new DBConnection();
            }

            return self::$connection;
        }

        public function closeConnection() {
            self::$connection = null;
        }
    }

?>