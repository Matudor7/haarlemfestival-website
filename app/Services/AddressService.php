<?php
require_once __DIR__ . '/../Models/Address.php';
require_once __DIR__ . '/../Repositories/AddressRepository.php';
class AddressService
{
    public function getAll()
    {
        $addressRepo = new AddressRepository();
        $addressRepo = $addressRepo->getAll();

        return $addressRepo;
    }


    public function getById(int $id){
        $addressRepo = new AddressRepository();
        $address = $addressRepo->getById($id);
        return $address;
    }

}