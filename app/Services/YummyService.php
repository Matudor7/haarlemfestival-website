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

    public function getById($restaurant_id)
    {
        $yummyRepo = new YummyRepository();
        $yummy = $yummyRepo->getById($restaurant_id);

        return $yummy;
    }
    public function insertRestaurant($restaurant){
        $yummyRepo = new YummyRepository();
        $yummyRepo->insertRestaurant($restaurant);

    }
}
