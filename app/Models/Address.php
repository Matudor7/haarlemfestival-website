<?php

class Address
{
    private int $address_id;
    private string $address_street;
    private string $address_city;
    private string $address_postcode;


    public function getAddressId(): int
    {
        return $this->address_id;
    }


    public function setAddressId(int $address_id): void
    {
        $this->address_id = $address_id;
    }


    public function getAddressStreet(): string
    {
        return $this->address_street;
    }


    public function setAddressStreet(string $address_street): void
    {
        $this->address_street = $address_street;
    }

    public function getAddressCity(): string
    {
        return $this->address_city;
    }

    public function setAddressCity(string $address_city): void
    {
        $this->address_city = $address_city;
    }


    public function getAddressPostcode(): string
    {
        return $this->address_postcode;
    }


    public function setAddressPostcode(string $address_postcode): void
    {
        $this->address_postcode = $address_postcode;
    }

}
?>