<?php

/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 04-28-2016
 * Time: 6:04 PM
 */

    class AddCarController {
        public function __construct($REQUEST_METHOD) {
            if ($REQUEST_METHOD == 'GET') {
                $this->getMethod();
            }

            if ($REQUEST_METHOD == 'POST') {
                $this->postMethod();
            }

        }

        private function getMethod() {
            $add_car_view = new AddCarFormView();
            $add_car_view->createForm();
            $add_car_form_html = $add_car_view->getHtml();

            echo $add_car_form_html;
        }

        private function postMethod() {
            $car_vin_number = $_POST['vin_number'];
            $price = $_POST['car_price'];
            $condition = $_POST['car_condition'];
            $creator = $_SESSION['logged_in_user']['email'];

            $db_connection = DBConnection::getConnection();
            $insert_car = 'INSERT INTO `Inventory` (`CreatedOn`, `CreatedBy`, `Price`, `VehicleCondition`, `VIN`) VALUES (NOW(), :createdBy, :vehiclePrice, :condition, :car_vin_number);';
            $db_connection->beginTransaction();
            try {
                $sql = $db_connection->prepare($insert_car);
                $sql->bindParam(':car_vin_number', $car_vin_number);
                $sql->bindParam(':vehiclePrice', $price);
                $sql->bindParam(':condition', $condition);
                $sql->bindParam(':createdBy', $creator);
                $sql->execute();

                $db_connection->commit();

                DBConnection::closeConnection();

                $home_link = new HtmlLink("Home", "index.php", "");
                echo $home_link->getLink();
            } catch (PDOException $e) {
                $db_connection->rollBack();

                DBConnection::closeConnection();
                $error_page = new Page($e->getMessage());
                echo $error_page->getHtml();
            }
        }
    }

?>