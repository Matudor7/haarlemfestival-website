<?php

class FoodType
{
    private int $foodType_id;
    private string $foodType;


    public function getFoodTypeId(): int
    {
        return $this->foodType_id;
    }


    public function setFoodTypeId(int $foodType_id): void
    {
        $this->foodType_id = $foodType_id;
    }


    public function getFoodType(): string
    {
        return $this->foodType;
    }

    public function setFoodType(string $foodType): void
    {
        $this->foodType = $foodType;
    }

}