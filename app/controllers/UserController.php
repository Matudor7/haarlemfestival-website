<?php
require_once __DIR__ . '/../Services/UserService.php';
require_once __DIR__ . '/../Services/eventService.php';
require_once __DIR__ .  '/controller.php';
require_once __DIR__ . '/../Models/userType.php';

class UserController extends Controller
{

    public function getAllUsers(){
        $userService = new UserService();
        return $userService->getAllUsers();
    }

    public function validateLogin($username, $password)
    {
        $userService = new UserService();
        return $userService->validateLogin($username, $password);
    }
    public function resetPasswordPage(){
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/user/resetPassword.php';
    }
    public function resetPassword(){
        require __DIR__ . '/../Services/smtpService.php';

        $smtp = new smtpService();
        $userService = new UserService();
        $email = $_POST['email'];
        $password = $this->generateRandomPassword();
        $user = $userService->getUserByEmail($email);
        $subject = "lets reset your password";
        $message = "This is your new temporary password: " .$password ." you can use this to login and create a new password for yourself or keep this one. Whatever makes you happier!";
        $userFirstName = $user->getUserFirstName();
        $smtp->sendEmail($email, $userFirstName , $message, $subject  );

        $userService->upDatePassword($user->getUserId(), $password);

        $_SESSION['passwordEmailMessage'] = "Your email was sent successfully!";
       require_once __DIR__ .  '/LoginController.php';
        $loginController = new LoginController();
        $loginController->index();

    }
    function generateRandomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; $pass = array(); //remember to declare
        $alphaLength = strlen($alphabet) - 1;
        //put the length -1 in cache
         for ($i = 0; $i < 8; $i++) { $n = rand(0, $alphaLength); $pass[] = $alphabet[$n]; } return implode($pass);
         //turn the array into a string
    }

}