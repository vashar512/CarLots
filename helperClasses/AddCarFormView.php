<?php

/**
 * Created by PhpStorm.
 * Author: vishalashar
 * Date: 04-28-2016
 * Time: 07:14 PM
 */

    class AddCarFormView {
        private $html;

        public function createForm() {
            $vin_number_field = new HtmlInput("text", "vin_number", "", "vin_number", "Vin Number", "", "true");
            $price_field = new HtmlInput("text", "car_price", "", "car_price", "Price", "", "true");

            $array = array("New", "Excellent", "Good", "Fair", "Needs Work");
            $condition_list = new HtmlList('car_condition', $array);
            $submit_button = new HtmlInput("submit", "submit", "Submit", "", "", "", "");

            $inputs = array($vin_number_field, $price_field, $condition_list, $submit_button);
            $add_car_form = new HtmlForm("index.php?pageType=addCar", $inputs, "POST");

            $form_html = $add_car_form->getForm();
            $this->html = $form_html;
        }

        public function getHtml() {
            return $this->html;
        }
    }

?>