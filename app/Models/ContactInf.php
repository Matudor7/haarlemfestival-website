<?php
class ContactInf
{

    private int $contactInf_id;
    private string $telephoneNumber;
    private string $email;

    public function getContactInfId(): int
    {
        return $this->contactInf_id;
    }


    public function setContactInfId(int $contactInf_id): void
    {
        $this->contactInf_id = $contactInf_id;
    }


    public function getTelephoneNumber(): string
    {
        return $this->telephoneNumber;
    }

    public function setTelephoneNumber(string $telephoneNumber): void
    {
        $this->telephoneNumber = $telephoneNumber;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}