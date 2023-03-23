<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
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

            require_once('../Controller/UserController.php');
            $userController = new UserController();

            $user = $userController->validateLogin($username, $password);

            if ($user != null) {
                $_SESSION['user'] = $user;
                header("location: /manageRestaurantPage");
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




