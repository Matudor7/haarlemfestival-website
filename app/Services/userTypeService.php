<?php
require __DIR__ . '/../Repositories/UserTypeRepository.php';
require_once __DIR__ . '/../Models/userType.php';
class userTypeService
{
    private $userTypeRepo;

    public function __construct() {
        $this->userTypeRepo = new UserTypeRepository(); 
    }

    public function getUserTypeByID($userType_id)
    {
        $userTypeRepo = new UserTypeRepository();
        $userType = $userTypeRepo->getTypeById();

        return $userType;
    }

    public function getAllUserType()
    {
        $userTypeRepo = new UserTypeRepository();
        $userTypes = $userTypeRepo->getAllUserType();
        return $userTypes;
    }

    public function getUserTypeNameByUserId($userId)
    {
        $userTypeName = $this->userTypeRepo->getUserTypeNameByUserId($userId);
        return $userTypeName;
    }

}