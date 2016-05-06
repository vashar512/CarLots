<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/23/16
 * Time: 1:21 PM
 */

    class SignUpView extends Page {

        public function __construct() {

            $window_on_load = 'window.onload = hideElement;';

            $email_check =
                'function checkEmail(input) {
                    var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

                    if (input.value === \'\' || !re.test(input.value)) {
                        document.getElementById(\'email_error\').innerHTML = "Email Address is not valid";
                        document.getElementById(\'submit_button\').disabled = true;
                    } else {
                        // The email address is in a valid format.
                        document.getElementById(\'email_error\').innerHTML = "";
                        document.getElementById(\'submit_button\').disabled = false;
                    }
                 }
                ';

            $hide =
                'function hideElement() {
                    document.getElementById(\'username_verify\').style.display = "none";
                 }
                ';

            $password_check_match =
                'function checkPassword(input) {
                    if (input.value === \'\' || input.value != document.getElementById(\'password\').value) {
                        document.getElementById(\'passwords_not_matching\').innerHTML = "Passwords do not match";
                        document.getElementById(\'submit_button\').disabled = true;
                    } else {
                        // input is valid -- reset the error message
                        document.getElementById(\'passwords_not_matching\').innerHTML = "";
                        document.getElementById(\'submit_button\').disabled = false;
                    }
                }';
            $javascript_html = new HtmlJavascript($password_check_match);
            echo $javascript_html->getHtml();
            $javascript_html = new HtmlJavascript($hide);
            echo $javascript_html->getHtml();
            $javascript_html = new HtmlJavascript($window_on_load);
            echo $javascript_html->getHtml();
            $javascript_html = new HtmlJavascript($email_check);
            echo $javascript_html->getHtml();

            $first_name = new HtmlInput("text", "first", "", "first_name", "First Name", "", "true");
            $last_name = new HtmlInput("text", "last", "", "last_name", "Last Name", "", "true");
            $email = new HtmlInput("text", "email_address", "", "email_address", "Email", "checkEmail(this)", "true");
            $password = new HtmlInput("password", "password", "", "password", "Password", "", "true");
            $password_verify = new HtmlInput("password", "password_verify_field", "", "password_verify_field",
                "Password Verify", "checkPassword(this)", "true");

            $username_verify = new HtmlInput("text", "username_verify", '', "username_verify", "",
                "", "false", "novalidate");

            $submit_button = new HtmlInput("submit", "submit_button", "Submit Button", "submit_button");

            $inputs = array($first_name, $last_name, $email, $password, $password_verify, $submit_button, $username_verify);

            $form = new HtmlForm("./index.php?pageType=signUp", $inputs, "POST");
            $this->html .= $form->getForm();
            $this->html .= '<div id=\'email_error\'></div>';
            $this->html .= '<div id=\'passwords_not_matching\'></div>';

        }
    }