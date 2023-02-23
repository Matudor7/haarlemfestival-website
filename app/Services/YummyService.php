<?php

require __DIR__ . '/../Repositories/YummyRepository.php';

class YummyService
{
    public function getAllRestaurants()
    {
        $yummyRepo = new YummyRepository();
        $yummyList = $yummyRepo->getAll();

        return $yummyList;
    }

    public function getByName(string $name)
    {
        $yummyRepo = new YummyRepository();
        $yummy = $yummyRepo->getByName($name);

        return $yummy;
    }
}
