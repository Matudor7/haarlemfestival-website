<?php
require __DIR__ . '/../Repositories/UserTypeRepository.php';
require_once __DIR__ . '/../Models/userType.php';
class userTypeService
{
    private $userTypeRepository; 

    //ctor
    public function __construct() {
        $this->userTypeRepository = new UserTypeRepository(); 
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
        $userTypeName = $this->userTypeRepository->getUserTypeNameByUserId($userId);
        return $userTypeName;
    }
    
}