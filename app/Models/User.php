<?php

class User
{
    private int $user_id;
    private string $username;
    private string $userPicURL = "";
    private string $user_firstName;
    private string $user_lastName;
    private string $user_email;
    private string $user_password;
    private int $userTypeId;
    private DateTime $user_registrationDate;


    public function getUserRegistrationDate(): DateTime
    {
        return $this->user_registrationDate;
    }

    public function setUserRegistrationDate(DateTime $user_registrationDate): void
    {
        $this->user_registrationDate = $user_registrationDate;
    }

    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }

    public function setUserTypeId(int $userTypeId): void
    {
        $this->userTypeId = $userTypeId;
    }


    public function getUserId(): int
    {
        return $this->user_id;
    }


    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUserPicURL(): string
    {
        return $this->userPicURL;
    }

    public function setUserPicURL(string $userPicURL): void
    {
        $this->userPicURL = $userPicURL;
    }

    public function getUserFirstName(): string
    {
        return $this->user_firstName;
    }

    public function setUserFirstName(string $user_firstName): void
    {
        $this->user_firstName = $user_firstName;
    }


    public function getUserLastName(): string
    {
        return $this->user_lastName;
    }


    public function setUserLastName(string $user_lastName): void
    {
        $this->user_lastName = $user_lastName;
    }


    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): void
    {
        $this->user_email = $user_email;
    }


    public function getUserPassword(): string
    {
        return $this->user_password;
    }

    public function setUserPassword(string $user_password): void
    {
        $this->user_password = $user_password;
    }

    public function getUserTypeName()
    {
        require_once __DIR__ . '/../Services/UserTypeService.php';
        require_once __DIR__ . '/../Models/userType.php';
        $userTypeService = new UserTypeService();
        $userType = $userTypeService->getUserTypeByID($this->userType_id);
        return $userType->getUserType();
    }

    public function getUserTypeName2($userId) // this one WORKS, the one above doesnt (at least for my code it didnt work), we should delete one. 
    //I didnt want to touch your code that's why i didnt delete or do anything -beth
    {
        require_once __DIR__ . '/../Services/UserTypeService.php';
        require_once __DIR__ . '/../Models/userType.php';
        $userTypeService = new UserTypeService();
        $userTypeName = $userTypeService->getUserTypeNameByUserId($userId);
        return $userTypeName;
    }
}