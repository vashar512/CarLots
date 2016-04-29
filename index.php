<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/11/16
 * Time: 10:50 AM
 */

    ini_set('display_errors', 'On');

    session_start();

    function autoload($class) {
        include 'helperClasses/' . $class . '.php';
    }
    spl_autoload_register('autoload');

    $request_method = $_SERVER['REQUEST_METHOD'];

    if (isset($_SESSION['logged_in_user'])) {
        $user_login_status = $_SESSION['logged_in_user'];
    } else {
        $user_login_status = '';
    }

    if (isset($request_method) && isset($_GET['pageType'])) {

        if ($_GET['pageType'] == 'home') {
            $home_controller = new HomeController($request_method);
        }

        if ($_GET['pageType'] == 'signIn') {
            if ($user_login_status == '') {
                $sign_in_controller = new SignInController($request_method);
            } else {
                $home_controller = new HomeController('GET');
            }
        }

        if ($_GET['pageType'] == 'signUp') {
            if ($user_login_status == '') {
                $sign_up_controller = new SignUpController($request_method);
            } else {
                $home_controller = new HomeController('GET');
            }
        }

        if ($_GET['pageType'] == 'validateUser') {
            if (isset($_GET['user_email']) && $_GET['user_email']) {
                $validate_user_controller = ValidateUserController::validateUser($_GET['user_email']);
            }
        }

        if ($_GET['pageType'] == 'logout') {
            if ($user_login_status != '') {
                $logout_controller = new LogoutController();
            } else {
                $home_controller = new HomeController('GET');
            }
        }

        if ($_GET['pageType'] == 'viewCars') {
            $view_cars_controller = new ViewCarsController($request_method, 'viewCars');
        }

        if ($_GET['pageType'] == 'viewCar') {
            if ($_GET['carId'] != null && $_GET['carId'] != '') {
                $view_cars_controller = new ViewCarsController($request_method, 'viewCar');
            } else {
                $error_page = new Page("No VIN Number Provided. Please try again with a VIN Number");
                echo $error_page->getHtml();
            }
        }

        if ($_GET['pageType'] == 'addCar') {
            if ($user_login_status != '') {
                $add_car_controller = new AddCarController($request_method);
            } else {
                $sign_in_controller = new SignInController('GET');
            }
        }

        if ($_GET['pageType'] == 'viewUserProfile') {
            if (isset($_GET['email']) && $_GET['email'] != '') {
                $user_profile_controller = new UserProfileController($request_method);
            }
        }
    }
    else {
        $home_controller = new HomeController('GET');
    }

?>