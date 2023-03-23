<?php
require __DIR__ . '/../Repositories/ContactInfRepository.php';

class ContactInfService
{
    public function getAllContactss()
    {
        $contactRepo = new YummyRepository();
        $contacts = $contactRepo->getAll();

        return $contacts;
    }


    public function getById($contactInf_id)
    {
        $contactRepo = new ContactInfRepository();
        $contact = $contactRepo->getById($contactInf_id);

        return $contact;
    }
}

