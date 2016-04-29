<?php

	class CarView {

		public function __construct($car, $curl_url) {
			$curl_driver = new CurlDriver($curl_url);
			$edmunds_response = $curl_driver->sendCurlRequest();
			$car_details = json_decode($edmunds_response, true);

			foreach($car as $field => $value) {
				echo $field . ':' . $car[$field] . '<br/><br/>';
			}

			$array_iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($car_details));

			foreach($array_iterator as $index => $item) {
				echo $index . ': ' . $item . '<br/>';
			}
		}

	}

?>