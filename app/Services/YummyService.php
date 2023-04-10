<?php

require __DIR__ . '/../Repositories/YummyRepository.php';

class YummyService
{
    private $yummyRepo;
    public function __construct()
    {
        $this->yummyRepo = new YummyRepository();
    }
    public function getAllRestaurants()
    {
        $yummyList = $this->yummyRepo->getAll();
        return $yummyList;
    }

    public function getByName(string $name)
    {
        $yummy = $this->yummyRepo->getByName($name);
        return $yummy;
    }

    public function getById($restaurant_id)
    {
        $yummy = $this->yummyRepo->getById($restaurant_id);
        return $yummy;
    }
    public function insertRestaurant($restaurant){
        return $this->yummyRepo->insertRestaurant($restaurant);
    }

    public function deleteRestaurant($id)
    {
        $this->yummyRepo->deleteRestaurant($id);
    }

    public function updateRestaurant($restaurant)
    {
        try{
            return $this->yummyRepo->updateRestaurant($restaurant);
        }catch (PDOException $e) {
            throw new Exception("Error updating restaurant: " . $e->getMessage());
        }

    }
}
