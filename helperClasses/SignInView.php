<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/24/16
 * Time: 3:29 PM
 */

    class SignInView extends Page {

        public function __construct() {
            $email_address_field = new HtmlInput("text", "user_email", "", "user_email",
                "Email", "checkEmail(this)", "true");
            $password_field = new HtmlInput("password", "user_password", "", "user_password",
                "Password", "", "true");

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

            $javascript_html = new HtmlJavascript($email_check);
            $this->html .= $javascript_html->getHtml();

            $submit = new HtmlInput("submit", "submit_button", "Sign In", "submit_button", "", "", "");

            $array = array($email_address_field, $password_field, $submit);

            $sign_in_form = new HtmlForm("index.php?pageType=signIn", $array, "POST");
            $this->html .= $sign_in_form->getForm();
            $this->html .= '<div id=\'email_error\'></div>';

            $home_link = new HtmlLink("Home", "index.php?pageType=home", "");
            $this->html .= $home_link->getLink();
        }

    }

?>