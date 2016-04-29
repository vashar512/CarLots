<?php

	class HtmlLink {

		private $link;

		public function __construct($link_name, $link_address, $link_target) {

			$this->link = '<a href="' . $link_address . '" target="' . $link_target . '">' . $link_name . '</a>';
		}

		public function getLink() {
			return $this->link;
		}

	}

?>