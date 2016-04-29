<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 1:29 PM
 */

    class Page {

        protected $html = '';

        public function __construct($html = '') {

            $this->html = $html;

        }

        public function getHtml() {

            $this->html .= '<br/>';
            return $this->html;

        }

    }

?>