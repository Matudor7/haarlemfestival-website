<?php

class userType
{
    private int $userTypeId;
    private string $userType;


    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }

    public function setUserTypeId(int $userTypeId): void
    {
        $this->userTypeId = $userTypeId;
    }


    public function getUserType(): string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): void
    {
        $this->userType = $userType;
    }
}