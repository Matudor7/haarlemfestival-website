<?php
session_start();
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
        $user = new User();
        $user = $this->userService->getByID($_SESSION['user_id']);

        //save the new profile
        if (isset($_POST['editbutton'])) {
            if(isset($_FILES['userManageAccountImageInput']) && $_FILES['userManageAccountImageInput']['error'] == 0){
                try {
                    $imageUrl = $_FILES['userManageAccountImageInput']['tmp_name'];
                    $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['userManageAccountUsernameTextBox'])));
                    $downloadPath = SITE_ROOT . '/media/userProfilePictures/' . $imageName . '.png'; 
                    move_uploaded_file($imageUrl, $downloadPath);
                    $downloadPath = str_replace(SITE_ROOT, '', $downloadPath); // remove SITE_ROOT from $downloadPath
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }               
            else{
                $downloadPath = $user->getUserPicURL(); //if new photo isnt added, the old photo remains as profile picture.
            }     
            $newUserProfile = new User();
            $newUserProfile->setUserFirstName($_POST['userManageAccountFirstNameTextBox']);
            $newUserProfile->setUserLastName($_POST['userManageAccountLastNameTextBox']);
            $newUserProfile->setUsername($_POST['userManageAccountUsernameTextBox']);
            $newUserProfile->setUserEmail($_POST['userManageAccountEmailTextBox']);
            $newUserProfile->setUserPassword($_POST['userManageAccountPassword1TextBox']);
            $newUserProfile->setUserPicURL($downloadPath);
            $this->userService->updateUserProfile($user, $newUserProfile);  
            $this->sendEditConfirmationMail($newUserProfile);
            header('Location: /user/userManageAccount'); 
        }  
        
        
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . "/../views/userManageAccount.php";
    }
    function sendEditConfirmationMail($user){
        require_once __DIR__ . '/../Services/smtpService.php';

        $subject = "Account Details Changed";
        $message = "Dear " . $user->getUserFirstName().  ", <br><br>
        We wanted to confirm that the changes you made to your account information have been successfully updated in our system. <br><br>
        Thank you for choosing our website and we hope you continue to enjoy our services. <br><br>
        Best regards, <br>
        'Haarlem Festival Website' team";
        $this->smtpService->sendEmail($user->getUserEmail(), $user->getUserFirstName() , $message, $subject);
    }

}