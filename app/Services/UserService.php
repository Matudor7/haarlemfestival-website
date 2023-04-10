<?php
require __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';
class UserService
{
    private $repository; 

    //ctor
    public function __construct() {
        $this->repository = new UserRepository(); 
    }
    public function getAllUsers()
    {
        $repository = new UserRepository;
        $users = $repository->getAllUsers();
        return $users;
    }
    public function validateLogin( $username, $password)
    {
        $repository = new UserRepository;
        return $repository->verifyLogin($username, $password);
    }

    public function getByID($id)
    {

        $repository = new UserRepository;
        $user = $repository->getUserById($id);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $repository = new UserRepository;
        $user = $repository->getUserByEmail($email);
        return $user;
    }

    public function upDatePassword($id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $repository = new UserRepository;

        $user = $repository->updatePassword($id, $hashedPassword);

    }

    public function createUser($user)
    {
        $repository = new UserRepository;
        $password = $user->getUserPassword();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->setUserPassword($hashedPassword);
        return  $repository->createUser($user);

    }
    public function getUserType(){
        return $this->repository->getUserType();
    }

    public function getAllUsersFromDatabase(){
        
        return $this->repository->getAllUsersFromDatabase();
    }

    public function deleteUser($user){
        
        return $this->repository->deleteUser($user);
    }
    public function updateUser($oldUser, $newUser){
        
        return $this->repository->editUserInDatabase($oldUser, $newUser);
    }

    public function getUsersBySearch($string){
        return $this->repository->getUsersBySearchFromDatabase($string);
    }
    public function getAllUsersByLaterRegistrationDate(){
        return $this->repository->getUsersByLaterRegistrationDate();
    }
    public function getAllUsersByUsrnameAlphabetical(){
        return $this->repository->getUsersByUsernameAlphabetical();
    }

    public function getAllAdminUsers(){
        $intOfAdmin = 2;
        return $this->repository->getUsersByType($intOfAdmin);
    }

    public function getAllEmployeeUsers(){
        $intOfEmployee = 1;
        return $this->repository->getUsersByType($intOfEmployee);
    }

    public function getAllCustomerUsers(){
        $intOfCustomer = 3;
        return $this->repository->getUsersByType($intOfCustomer);
    }
    public function updateUserProfile($oldUser, $newUser){
        $password = $newUser->getUserPassword();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser->setUserPassword($hashedPassword);
        return $this->repository->editUserProfileInDatabase($oldUser, $newUser);
    }
    public function updateUserProfile($oldUser, $newUser){
        $repository = new UserRepository; //TODO create ctor this is duplicate code -beth
        $password = $newUser->getUserPassword();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser->setUserPassword($hashedPassword);
        return $repository->editUserProfileInDatabase($oldUser, $newUser);
    }

}