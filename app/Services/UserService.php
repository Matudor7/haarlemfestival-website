<?php
require __DIR__ . '/../Repositories/UserRepository.php';
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

}