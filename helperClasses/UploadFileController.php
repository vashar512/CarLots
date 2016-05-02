<?php

	class UploadFileController {
	
		private static $target_directory = './images/';

		public function __construct() {
			// $this->post();
		}

		private function get() {
			$html_upload_input = new HtmlInput('File', 'fileInput',
			'', 'fileInput', 'File Input Directory');
						
			$html_upload_button = new HtmlInput('Submit',
			'fileUploadButton', 'Upload CSV File', 'fileUploadButton', '');

			$inputs = array($html_upload_input,
			$html_upload_button);

			$html_upload_form = new
			HtmlForm('index.php?pageType=uploadCarsCsv', $inputs,
			'POST');

			$html_upload_form->updateHtml('index.php?pageType=uploadCarsCsv', $inputs, 'POST', 'multipart/form-data');

			$this->html = $html_upload_form->getForm();

			echo $this->html;
		}

		public static function uploadFile() {
			$file_name = self::$target_directory . $_FILES['vehicle_image']['name'];
			$uploadOk = 0;

            if (isset($_POST['submit'])) {
				if (file_exists($file_name)) {
					$extensionOfFile = pathinfo($file_name, PATHINFO_EXTENSION);
					echo $extensionOfFile;
				}

				if (!file_exists($file_name)) {
					$extensionOfFile = pathinfo($file_name, PATHINFO_EXTENSION);

					if (move_uploaded_file($_FILES['vehicle_image']['tmp_name'], $file_name)) {
						$uploadOk = 1;
					}
					else {
						$uploadOk = 0;
					}
				}
			} else {
				$uploadOk = 2;
			}

			self::checkUploadStatus($uploadOk);
		}

		public static function uploadImage($tmp_name, $file_name) {
			if (move_uploaded_file($tmp_name, $file_name)) {
				$statusCode = 1;
			}
			else {
				$statusCode = 0;
			}

			return $statusCode;
		}

		private static function checkUploadStatus($status)
		{
			if ($status == 0) {
				echo '<script>location.replace("https://web.njit.edu/~vha6/IS218/CarLots/index.php?pageType=addCar</script>';
			}
			if ($status == 1) {
				echo 'File Uploaded Successfully';
			}
			if ($status == 2) {
				echo 'Submit button not set';
			}
		}
	}

?>
