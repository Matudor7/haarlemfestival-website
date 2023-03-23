<?php
require_once __DIR__ . '/../Repositories/FoodTypeRepository.php';
class FoodTypeService
{
    public function getAllFoodType()
    {
        $foodTypeRepo = new FoodTypeRepository();
        $foodType = $foodTypeRepo->getAllTypes();

        return $foodType;
    }

    public function getAllFoodTypeByID($foodType_id)
    {
        $foodTypeRepo = new FoodTypeRepository();
        $foodType = $foodTypeRepo->getFoodTypeByID($foodType_id);

        return $foodType;
    }
}