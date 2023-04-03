<?php
require __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';
class UserService
{
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
        $repository = new UserRepository;
        return $repository->getUserType();
    }

    public function getAllUsersFromDatabase(){
        $repository = new UserRepository; //TODO create ctor this is duplicate code -beth
        return $repository->getAllUsersFromDatabase();
    }

    public function deleteUser($user){
        $repository = new UserRepository; //TODO create ctor this is duplicate code -beth
        return $repository->deleteUser($user);
    }

    public function getUsersBySearch($string){
        $repository = new UserRepository;
        return $repository->getUsersBySearchFromDatabase($string);
    }
    public function getAllUsersByLaterRegistrationDate(){
        $repository = new UserRepository;
        return $repository->getUsersByLaterRegistrationDate();
    }
    public function getAllUsersByUsrnameAlphabetical(){
        $repository = new UserRepository;
        return $repository->getUsersByUsernameAlphabetical();
    }

    public function getAllAdminUsers(){
        $repository = new UserRepository;
        $intOfAdmin = 2;
        return $repository->getUsersByType($intOfAdmin);
    }

    public function getAllEmployeeUsers(){
        $repository = new UserRepository;
        $intOfEmployee = 1;
        return $repository->getUsersByType($intOfEmployee);
    }

    public function getAllCustomerUsers(){
        $repository = new UserRepository;
        $intOfCustomer = 3;
        return $repository->getUsersByType($intOfCustomer);
    }

}