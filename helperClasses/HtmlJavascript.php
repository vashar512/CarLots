<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 2:53 PM
 */

    class HtmlJavascript {

        private $javascript_html = '';

        public function __construct($javascript_function) {
            $this->javascript_html = '<script language=\'javascript\' type=\'text/javascript\'>';
            $this->enterJavascript($javascript_function);
            $this->javascript_html .= '</script>';
        }

        private function enterJavascript($javascript_function) {
            $this->javascript_html .= $javascript_function;
        }

        public function getHtml() {
            return $this->javascript_html;
        }

    }

?>