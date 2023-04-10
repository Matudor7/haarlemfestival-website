<?php
session_start();
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../Services/eventService.php';
require_once __DIR__ . '/../Services/UserService.php';

class LoginController extends Controller
{
    public function index()
    {
        //$eventService = new EventService();
        //$events = $eventService->getAll();
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/login.php';
    }

    public function loginValidation()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userService = new UserService();
        $user = $userService->validateLogin($username, $password);

        if ($user != null) { 
            session_start();
            $_SESSION['user_id'] = $user->getUserId();
            $_SESSION['user_role'] = $user->getUserTypeId(); // 1 = employee, 2 = admin, 3 = costumer
            header("location: /");
        } else {
            $_SESSION['LoginError'] = "Username or password incorrect!";
            $this->index()();
        }
    }

    public function logOut(){
       // session_start();
        session_destroy();
        header('Location: /');
        exit;
    }


}