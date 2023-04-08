<?php
require_once __DIR__ . '/../Services/UserService.php';
require_once __DIR__ . '/../Services/eventService.php';
require_once __DIR__ .  '/controller.php';
require_once __DIR__ . '/../Models/userType.php';
require_once __DIR__ . '/../Services/smtpService.php';
require_once __DIR__ . '/../Models/User.php';

class UserController extends Controller
{
    private $userService;
    private $eventService;
    private $smtpService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->userService = new UserService();
        $this->smtpService = new smtpService();
    }

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

    function userManageAccount(){
        $events = $this->eventService->getAll();
        session_start();
        $user = new User();
        $user->setUserId($_SESSION['user_id']);
        $user->setUsername($_SESSION['username']);
        $user->setUserTypeId($_SESSION['user_role']);
        $user->setUserFirstName($_SESSION['user_firstName']);
        $user->setUserLastName($_SESSION['user_lastName']);
        $user->setUserPicURL($_SESSION['user_imageUrl']);
        $user->setUserEmail($_SESSION['user_email']);
        //save the new things
        //send the email

        require __DIR__ . "/../views/userManageAccount.php";
    }

    function sendEditConfirmationMail($user, $userEmailAddress){
        require __DIR__ . '/../Services/smtpService.php';

        $subject = "Account Details Changed";
        $message = "Dear " . $user->getUserFirstName.  ", \nWe wanted to confirm that the changes you made to your account information have been successfully updated in our system. \n
        Thank you for choosing our website and we hope you continue to enjoy our services.\nBest regards,\n'Haarlem Festival Website' team";
        $this->smtpService->sendEmail($userEmailAddress, $user->getUserFirstName , $message, $subject);
    }

}