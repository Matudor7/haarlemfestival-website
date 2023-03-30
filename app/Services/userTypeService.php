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

}