<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 04-29-2016
 * Time: 9:11 AM
 * {@class CarModel} - Model of cars stored.
 */

    class CarModel {
        private $vin_number = '';
        private $price = '';
        private $condition = '';

        private $created_on = '';
        private $creator = '';

        public function __construct($vin_number, $price, $condition, $created_on, $creator) {
            $this->setVinNumber($vin_number);
            $this->setPrice($price);
            $this->setCondition($condition);
            $this->setCreatedOn($created_on);
            $this->setCreatedBy($creator);
        }

        /**
         * @param string $vin_number
         */
        private function setVinNumber($vin_number)
        {
            $this->vin_number = $vin_number;
        }






        public function getVinNumber()
        {
            return $this->vin_number;
        }

        /**
         * @param string $price
         */
        private function setPrice($price)
        {
            $this->price = $price;
        }

        public function getPrice()
        {
            return $this->price;
        }

        private function setCondition($condition)
        {
            $this->condition = $condition;
        }

        public function getCondition()
        {
            return $this->condition;
        }

        private function setCreatedOn($created_on)
        {
            $this->created_on = $created_on;
        }

        public function getCreatedOn()
        {
            return $this->created_on;
        }

        private function setCreatedBy($created_by)
        {
            $this->creator = $created_by;
        }

        public function getCreatedBy()
        {
            return $this->creator;
        }

        public function toArray() {
            $array = array('created_on'=>$this->getCreatedOn(), 'creator'=>$this->getCreatedBy(), 'price'
            =>$this->getPrice(), 'condition'=>$this->getCondition(),
                'vin'=>$this->getVinNumber());

            return $array;
        }
    }