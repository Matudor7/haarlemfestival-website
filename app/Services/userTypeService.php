<?php
require __DIR__ . '/../Repositories/UserTypeRepository.php';
require_once __DIR__ . '/../Models/userType.php';
class userTypeService
{
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
        $userTypeRepo = new UserTypeRepository(); // we need to create a constructor. this is only DUPLICATE CODE -beth
        $userTypeName = $userTypeRepo->getUserTypeNameByUserId($userId);
        return $userTypeName;
    }
    
}