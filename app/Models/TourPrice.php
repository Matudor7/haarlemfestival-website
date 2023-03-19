<?php
class TourPrice
{
    private int $walkingTour_Price_id;
    private float $walkingTour_Price_price;
    private string $walkingTour_Price_description;

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

    //setters
    public function setPrice(float $walkingTour_Price_price): void
    {
        $this->walkingTour_Price_price = $walkingTour_Price_price;
    }

    public function setDescription(string $walkingTour_Price_description): void
    {
        $this->walkingTour_Price_description = $walkingTour_Price_description;
    }
    public function setPriceId(int $walkingTour_Price_id): void
    {
        $this->walkingTour_Price_id = $walkingTour_Price_id;
    }
}
?>