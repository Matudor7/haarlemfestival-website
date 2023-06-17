<?php
session_start();
require_once __DIR__ . '/../Services/UserService.php';
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
        $this->userService = new UserService();
        $this->smtpService = new smtpService();
    }
    public function registerUserPage()
    {
        require __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../views/user/registerUser.php';
    }

    public function registerNewUser(){
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->registerUserPage();
            } else if($_SERVER["REQUEST_METHOD"] == "POST") {
                $user = new User();
                $user->setUserFirstName($_POST['firstname']);
                $user->setUserLastName($_POST['lastname']);
                $user->setUserPassword($_POST['password']);
                $user->setUsername($_POST['username']);
                $user->setUserEmail($_POST['email']);

                $captchaResponse = $_POST['g-recaptcha-response'];

                if ($this->validateCaptcha($captchaResponse)) {

                    if ($this->userService->createUser($user)) {
                        $header = "All set!";
                        $userCreationMessage = "User registered successfully!!!!";
                        $status = "success";
                    } else {
                        $header = "Oh no!";
                        $userCreationMessage = "User was not registered, please verify the given details and try again.";
                        $status = "danger";
                    }

                } else {
                    $header = "Don't forget..";
                    $userCreationMessage = "Please check the user verification box and try again.";
                    $status = "warning";
                }
                if (isset($userCreationMessage)) {
                    $response = ['header'=> $header, 'message'=>$userCreationMessage, 'status'=>$status];
                } else {
                    $response = ['header'=>"Something went wrong!" ,
                        'message'=>"There was an error when registering the user. verify the details and try again later",
                        'status'=>"warning"];
                }
                $this->registrationResponsePage($response);
            }
    }
    function registrationResponsePage($response){
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/user/registerResult.php';

    }
    public function validateCaptcha($captchaResponse){
        if(isset($captchaResponse)&&!empty($captchaResponse)){
            $secretKey = "6LfIsI8mAAAAAE14_FOlwvwNhrvPH0BH2XHjAXgy";
            $serverResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$captchaResponse);

            $data = json_decode($serverResponse);

            if ($data->success){
                return true;
            }

            return false;
        }
    }
    public function getAllUsers(){
        return $this->userService->getAllUsers();
    }

    public function validateLogin($username, $password)
    {
        return $this->userService->validateLogin($username, $password);
    }
    public function resetPasswordPage(){
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/user/resetPassword.php';
    }
    public function resetPassword(){

        $email = $_POST['email'];
        $password = $this->generateRandomPassword();
        $user = $this->userService->getUserByEmail($email);
        $subject = "lets reset your password";
        $message = "Dear " . $user->getUserFirstName() .  ", This is your new temporary password: " .$password ." \nYou can use this to login and create a new password for yourself or keep this one. Whatever makes you happy! \n
        Thank you for choosing our website and we hope you continue to enjoy our services.\nBest regards,\n'Haarlem Festival Website' team";
        $userFirstName = $user->getUserFirstName();
        $smtp = $this->smtpService->sendEmail($email, $userFirstName , $message, $subject  );

        $this->userService->upDatePassword($user->getUserId(), $password);

        $_SESSION['passwordEmailMessage'] = "Your email was sent successfully!";
        header('Location: /login');
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