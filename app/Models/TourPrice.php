<?php
class TourPrice
{
    private int $walkingTour_Price_id = 0;
    private float $walkingTour_Price_price = 0;
    private string $walkingTour_Price_description = "";
    private int $walkingTour_Price_amoutofPeople = 0;

    //getters
    public function getPriceId(): int
    {
        return $this->walkingTour_Price_id;
    }

    public function getPrice(): float
    {
        return $this->walkingTour_Price_price;
    }

    public function getDescription(): string
    {
        return $this->walkingTour_Price_description;
    }

    public function getAmountofPeople(): int{
        return $this->walkingTour_Price_amoutofPeople;
    }
    //setters
    public function setPrice(float $walkingTour_Price_price): void
    {
        $this->walkingTour_Price_price = $walkingTour_Price_price;
    }

    public function setDescription(string $walkingTour_Price_description): void
    {
        $this->walkingTour_Price_description = $walkingTour_Price_description;
    }
    public function setPriceId(int $id): void
    {
        $this->walkingTour_Price_id = $id;
    }
    public function setAmountofPeople(int $amount){
        $this->walkingTour_Price_amoutofPeople = $amount;
    }
}
?>