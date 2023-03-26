<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../Services/eventService.php';
require_once __DIR__ . '/../Services/UserService.php';

class LoginController extends Controller
{
    public function index()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/login.php';
    }


    public function loginValidation(){
        if (isset($_POST['LoginButton'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];


            $userService = new UserService();

            $user = $userService->validateLogin($username, $password);

            if ($user != null) {
                $_SESSION['user'] = $user;
               header("location: /admin/manageRestaurants");
            } else {
                $_SESSION['LoginError'] = "Username or password incorrect!";
                header("location: /Login");
            }
        }}


    public function logOut(){
        session_start();
        session_destroy();
        header('location:/localhost');
    }
}




