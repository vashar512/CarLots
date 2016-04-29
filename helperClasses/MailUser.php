<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 6:53 PM
 */

    class MailUser {
        private $user_email_address = '';
        private $subject = 'Account Validation';
        private $body = '
        ';
        private $user_validation_link = '';

        public function __construct($user_email_address = '') {
            if ($user_email_address === '') {
                return "Cannot send email. No email address provided.";
            }

            $this->user_email_address = $user_email_address;
            $validation_link = 'https://web.njit.edu/~vha6/IS218/CarLots/index.php?pageType=validateUser&user_email=' . $this->user_email_address;
            $this->user_validation_link = $this->getTinyValidationUrl($validation_link);
            $this->body = '
                Thank you for signing up.

                Before you can access any of the website features, please click on the link below to validate the email address

                ' . $this->user_validation_link . '

                Thanks,
                /n

                From the Website Team
            ';
        }

        public function sendEmail() {
            return mail($this->user_email_address, $this->subject, $this->body);
        }

        private function getTinyValidationUrl($user_validation_link = '') {
            $curlDriver = new CurlDriver('http://tinyurl.com/api-create.php?url=' . $user_validation_link);
            $tinyUrl = $curlDriver->sendCurlRequest();
            $curlDriver->closeCurlConnection();
            return $tinyUrl;
        }
    }

?>