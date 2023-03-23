<?php
require __DIR__ . '/Services/UserService.php';
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
}