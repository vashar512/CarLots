<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 12:05 PM
 */

	class HtmlForm {
        private $htmlFormTag = '';

        private $action = '';
        private $inputs;
        private $method = '';
        private $encodingType = '';

        public function __construct($action, $inputs, $method) {
            $this->updateHtml($action, $inputs, $method, '');
        }

        public function setEncodingType($type) {
            $this->encodingType = $type;

        }

        public function setAction($action) {
            $this->action = $action;
        }

        public function setMethod($method) {
            $this->method = $method;
        }

        public function updateInputs($inputs) {
            $this->inputs = $inputs;
        }

        public function updateHtml($action = '', $inputs = '', $method = '', $encType = '') {
            $this->setAction($action);
            $this->setMethod($method);
            $this->setEncodingType($encType);
            $this->updateInputs($inputs);

            $this->htmlFormTag = '<form action="' . $this->action . '" method="' . $this->method . '" enctype="' . $this->encodingType . '">';
            foreach($this->inputs as $input) {
                if ($input instanceof HtmlInput) {
                    $this->htmlFormTag .= $input->getLabelHtml();
                    $this->htmlFormTag .= $input->getInputTagHtml();
                    $this->htmlFormTag .= '<br/>';
                }

                if ($input instanceof HtmlList) {
                    $this->htmlFormTag .= $input->getList();
                }
            }

            $this->htmlFormTag .= '</form>';
        }

        public function getForm() {
            return $this->htmlFormTag;
        }
    }

?>
