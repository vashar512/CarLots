<?php

	class HtmlTable extends Table {

		public function __construct($cars = null) {
			print_r($cars);

			if (!is_null($cars) && count($cars) > 0) {
				$this->table .= '<table style="border:1px solid black; border-collapse:collapse;">';

				foreach ($cars as $id => $car) {
					$properties = array_keys($car);
					break;
				}

				$this->table .= '<tr style="border:1px solid black; background: grey;">';

				foreach ($properties as $property) {
					$this->table .= '<th style="border:1px solid black;">';
					$this->table .= $property;
					$this->table .= '</th>';
				}

				$this->table .= '<th style="border:1px solid black;">';
				$this->table .= 'View';
				$this->table .= '</th>';

				$this->table .= '</tr>';

				foreach ($cars as $id => $car) {
					$this->table .= '<tr style="border:1px solid black;">';

					foreach ($car as $key => $value) {
						$this->table .= '<td style="border:1px solid black;">';
						print_r($car);
						if ($key == 'image') {
							if ($value != null && $value != '') {
								$this->table .= '<img src="' . $value . '" style="width: 50px; height: 50px;"></img>';
							}
							else {
								$this->table .= '<img src="images/no-image.gif" style="width: 50px; height: 50px;"></img>';
							}
						} else {
							if ($key == 'creator') {
								$user_profile_link = new HtmlLink($value, "index.php?pageType=viewUserProfile
								&email=" . $value, "");

								$this->table .= $user_profile_link->getLink();
							} else {
								if ($key != 'image') {
									$this->table .= $value;
								}
							}
						}
						$this->table .= '</td>';
					}

					$viewCar = new HtmlLink('viewCar', 'index.php?pageType=viewCar&carId=' . $id, '');
					$this->table .= '<td style="border:1px solid black;">';
					$this->table .= $viewCar->getLink();
					$this->table .= '</td>';

//					$editCar = new HtmlLink('editCar', 'index.php?pageType=editCar&carId=' . $id, '');
//					$this->table .= '<td style="border:1px solid black;">';
//					$this->table .= $editCar->getLink();
//					$this->table .= '</td>';

					$this->table .= '</tr>';
				}

				$this->table .= '</table>';
			}
			else {
				$this->table .= '<table style="border:1px solid black; border-collapse:collapse;">';
				$this->table .= '</table>';
			}
		}

	}
	
?>