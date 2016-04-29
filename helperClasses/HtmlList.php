<?php

/**
 * Created by PhpStorm.
 * Author: vishalashar
 * Date: 04-28-2016
 * Time: 10:58 PM
 * {@code HtmlList}
 */

    class HtmlList {
        private $select = '';

        public function __construct($id = '', $options) {
            $this->select = '<select name="' . $id . '">';
            $this->createOptions($options);
        }

        private function createOptions($options) {
            if (isset($options)) {
                if (count($options) > 0) {
                    foreach($options as $option) {
                        $this->select .= '<option id="' . $option . '" value="' . $option . '">' . $option .
                            '</option>';
                    }
                } else {
                    $this->select .= '</select>';
                    exit();
                }
            } else {
                $this->select .= '</select>';
                exit();
            }
        }

        public function getList() {
            return $this->select;
        }
    }