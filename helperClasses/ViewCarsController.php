<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/28/16
 */


    class ViewCarsController {

        private $server_credentials_file_path = './server_creds.txt';
        private $key = '';

        public function __construct($REQUEST_METHOD, $page_type) {
            if ($REQUEST_METHOD == 'GET') {
                $this->getMethod($page_type);
            }

            if ($REQUEST_METHOD == 'POST') {

            }
        }

        private function getMethod($page_type)
        {
            if ($page_type == 'viewCars') {
                $cars_view = new CarsView();
                $cars_view_page = new Page($cars_view->getHtml());
                echo $cars_view_page->getHtml();
            }

            if ($page_type == 'viewCar') {
                if (isset($_GET['carId'])) {
                    $db_connection = DBConnection::getConnection();
                    $get_car = $db_connection->prepare('SELECT `CreatedBy`, `CreatedOn`, `Price`, `VehicleCondition`, `VIN`, `ImageName` FROM `Inventory` WHERE `VIN`=:vin_number');
                    $get_car->bindParam(':vin_number', $_GET['carId']);
                    $get_car->execute();

                    $car = $get_car->fetch(PDO::FETCH_ASSOC);

                    DBConnection::closeConnection();

                    $server_credential_contents = file_get_contents($this->server_credentials_file_path);

                    $file_contents_array = explode(PHP_EOL, $server_credential_contents);

                    $api_key = $file_contents_array[3];
                    $this->key = $api_key;

                    if ($car != null && $car != '') {
                        $url = 'https://api.edmunds.com/api/vehicle/v2/vins/' . $car['VIN'] . '?fmt=json&api_key=' . $this->key;
                        $car_view = new CarView($car, $url);

                    } else {
                        $error_page = new Page("Incorrect VIN Number. Please check and try again later.");
                        echo $error_page->getHtml();
                    }

                }
            }
        }
        
    }

?>