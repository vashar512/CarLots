<?php

    class HtmlInput {
		private $type;
		private $name;
		private $value;
		private $id;
		private $label_text;
		private $on_input;
		private $required;

		private $htmlLabel = '';
		private $htmlInputTag = '';

		public function __construct($type = '', $name = '', $value = '', $id = '', $label_text = '', $on_input = '', $required = '') {
			$this->type = $type;
			$this->name = $name;
			$this->value = $value;	
			$this->id = $id;
			$this->label_text = $label_text;
			$this->on_input = $on_input;
			$this->required = $required;
			$this->createLabel();	
			$this->createHtml();	
		}

		private function createLabel() {
			$this->htmlLabel .= '<label for="' . $this->id . '"> ' . $this->label_text . ' </label>';
		}

		private function createHtml() {
			$this->htmlInputTag .= '<input value="' . $this->value . '" type="' . $this->type . '" id="' . $this->id .
				'" name="' . $this->name . '" oninput="' . $this->on_input . '" required= "' . $this->required . '">
				</input>';
		}

		public function getValuesArray() {
			return get_object_vars($this);
		}

		public function getInputTagHtml() {
			return $this->htmlInputTag;
		}

		public function getLabelHtml() {
			return $this->htmlLabel;	
		}

		public function getValue() {
			return $this->value;
		}

	}

?>