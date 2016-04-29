<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 1:02 PM
 */

    class CarsView {

        private $html = '';
        private $cars = array();

        public function __construct() {

            $db_connection = DBConnection::getConnection();
            $get_inventory = $db_connection->prepare("SELECT * FROM `Inventory`");
            $get_inventory->execute();

            $inventory = $get_inventory->fetchAll();

            foreach($inventory as $car) {
                $vin = $car['VIN'];
                $price = $car['Price'];
                $condition = $car["VehicleCondition"];
                $created_on = $car["CreatedOn"];
                $creator = $car["CreatedBy"];

                echo $vin;

                $car = new CarModel($vin, $price, $condition, $created_on, $creator);
                $this->cars[$vin] = $car->toArray();
            }

            DBConnection::closeConnection();

            $inventory_table = new HtmlTable($this->cars);

            $session_status = session_status();

            $this->html = $inventory_table->getTable();

            if ($session_status != 'PHP_SESSION_DISABLED' && isset($_SESSION['logged_in_user']) && $_SESSION['logged_in_user'] != '') {
                $add_car_link = new HtmlLink("Add Car", "index.php?pageType=addCar", "");
                $this->html .= $add_car_link->getLink();
            }

        }

        public function getHtml() {
            return $this->html;
        }

    }

?>