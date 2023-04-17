<?php

class RestaurantModel
{
    private int $restaurant_id;
    private string $restaurant_name;
    private float $restaurant_kidsPrice;
    private float $restaurant_adultsPrice;
    private string $restaurant_OpeningTime;
    private int $restaurant_numberOfAvailableSeats;
    private int $numberOfTimeSlots;
    private string $duration;
    private bool $restaurant_isItAvailable;
    private int $restaurant_addressId;
    private bool $havaDetailPageOrNot;
    private int $detail_id;
    private int $contactInf_id;
    private string $restaurant_pictureURL = "";
    private int $foodType_id;
    private int $restaurantRating_id;



    public function getRestaurantRatingId(): int
    {
        return $this->restaurantRating_id;
    }

    public function setRestaurantRatingId(int $restaurantRating_id): void
    {
        $this->restaurantRating_id = $restaurantRating_id;
    }


    public function getContactInfId(): int
    {
        return $this->contactInf_id;
    }


    public function setContactInfId(int $contactInf_id): void
    {
        $this->contactInf_id = $contactInf_id;
    }

    public function getDetailId(): int
    {
        return $this->detail_id;
    }

    public function setDetailId(int $detail_id): void
    {
        $this->detail_id = $detail_id;
    }


    public function getFoodTypeId(): int
    {
        return $this->foodType_id;
    }


    public function setFoodTypeId(int $foodType_id): void
    {
        $this->foodType_id = $foodType_id;
    }




    public function setRestaurantFoodType(string $foodType): void {
        $this->restaurant_foodType = $foodType;
    }

    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

    public function setRestaurantId(int $restaurant_id): void
    {
        $this->restaurant_id = $restaurant_id;
    }

    public function getRestaurantNumberOfAvailableSeats(): int
    {
        return $this->restaurant_numberOfAvailableSeats;
    }

    public function setRestaurantNumberOfAvailableSeats(int $restaurant_numberOfAvailableSeats): void
    {
        $this->restaurant_numberOfAvailableSeats = $restaurant_numberOfAvailableSeats;
    }

    public function getNumberOfTimeSlots(): int
    {
        return $this->numberOfTimeSlots;
    }

    public function setNumberOfTimeSlots(int $numberOfTimeSlots): void
    {
        $this->numberOfTimeSlots = $numberOfTimeSlots;
    }

    public function getRestaurantAddressId(): int
    {
        return $this->restaurant_addressId;
    }

    public function setRestaurantAddressId(int $restaurant_addressId): void
    {
        $this->restaurant_addressId = $restaurant_addressId;
    }

    public function getRestaurantName(): string
    {
        return $this->restaurant_name;
    }

    public function setRestaurantName(string $restaurant_name): void
    {
        $this->restaurant_name = $restaurant_name;
    }

    public function getRestaurantPictureURL(): string
    {
        return $this->restaurant_pictureURL;
    }

    public function setRestaurantPictureURL(string $restaurant_pictureURL): void
    {
        $this->restaurant_pictureURL = $restaurant_pictureURL;
    }


    public function getRestaurantKidsPrice(): float
    {
        return $this->restaurant_kidsPrice;
    }

    public function setRestaurantKidsPrice(float $restaurant_kidsPrice): void
    {
        $this->restaurant_kidsPrice = $restaurant_kidsPrice;
    }

    public function getRestaurantAdultsPrice(): float
    {
        return $this->restaurant_adultsPrice;
    }
    public function getFoodTypeName(){
        require_once __DIR__ . '/../Services/FoodTypeService.php';
        require_once __DIR__ . '/../Models/FoodType.php';
        $foodTypeService = new FoodTypeService();
        $foodType = $foodTypeService->getAllFoodTypeByID($this->foodType_id);
        return $foodType->getFoodType();
    }
    public function getRestaurantRating(){
        require_once __DIR__ . '/../Services/RatingService.php';
        require_once __DIR__ . '/../Models/RestaurantRating.php';
        $ratingService = new RatingService();
        $restaurantRating = $ratingService->getAllRatingById($this->restaurantRating_id);
        return $restaurantRating->getRatingNumber();
    }


    public function setRestaurantAdultsPrice(float $restaurant_adultsPrice): void
    {
        $this->restaurant_adultsPrice = $restaurant_adultsPrice;
    }

    public function getRestaurantOpeningTime()
    {
        return date('H:i', strtotime($this->restaurant_OpeningTime));
    }

    public function setRestaurantOpeningTime( $restaurant_OpeningTime): void
    {
        $this->restaurant_OpeningTime = $restaurant_OpeningTime;
    }

    public function getDuration()
    {
        return date('H:i', strtotime($this->duration));
    }

    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function isRestaurantIsItAvailable(): bool
    {
        return $this->restaurant_isItAvailable;
    }

    public function setRestaurantIsItAvailable(bool $restaurant_isItAvailable): void
    {
        $this->restaurant_isItAvailable = $restaurant_isItAvailable;
    }
    private function setTimeSlots(int $numberOfTimeSlots, string $restaurant_OpeningTime, string $duration): array {
        $timeSlots = array();

        // Create DateTime objects from the input strings
        $openingTime = new DateTime($restaurant_OpeningTime);
        $hour = explode(':', $duration)[0];
        $minutes = explode(':', $duration)[1];
        $slotDuration = new DateInterval('PT'.$hour.'H'.$minutes.'M');

        // Use the opening time as the starting time for the time slots
        $currentTime = clone $openingTime;

        for ($i = 0; $i < $numberOfTimeSlots; $i++) {
            // Format the DateTime object as 'hh:mm'
            $timeSlots[] = $currentTime->format('H:i');
            $currentTime->add($slotDuration);
        }

        return $timeSlots;
    }
    public function getTimeSlots(){

        return $this->setTimeSlots($this->numberOfTimeSlots, $this->restaurant_OpeningTime, $this->duration);
    }

    public function displayImageBasedOnEnum($string) {
        switch ($string) {
            case '1':
                echo '<img src="media/yummyPics/1star.png" alt="1 star ">';
                break;
            case '2':
                echo '<img src="media/yummyPics/2stars.png" alt="2 stars ">';
                break;
            case '3':
                return  '<img src="media/yummyPics/3starsPic.png" alt="3 stars ">';
                break;
            case '4':
                return '<img src="media/yummyPics/4starsPic.png" alt="4 stars">';
                break;
            case '5':
                return '<img src="media/yummyPics/5stars.png" alt="5 stars">';
                break;
        }

    }

    public function getHavaDetailPageOrNot(): bool
    {
        return ($this->havaDetailPageOrNot);
    }

    public function setHavaDetailPageOrNot($havaDetailPageOrNot): void
    {
        $this->havaDetailPageOrNot = $havaDetailPageOrNot === 'yes';
    }

    public function getDetailPageAsYesOrNoTxt(): string
    {
        return ($this->havaDetailPageOrNot) ? 'yes' : 'no';
    }
    public function getHavaDetailPageOrNotAsInt(): int
    {
        return ($this->havaDetailPageOrNot) ? 1 : 0;
    }

    public function setHavaDetailPageOrNotAsInt(int $havaDetailPageOrNot): void
    {
        $this->havaDetailPageOrNot = ($havaDetailPageOrNot === 1) ? 'yes' : 'no';
    }
}


