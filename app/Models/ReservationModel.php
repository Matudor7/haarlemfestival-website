<?php
class Reservation implements JsonSerializable{
   private int $reservation_id = 0;
   private int $reservation_nrOfAdults = 0;
   private int $reservation_nrOfKids = 0;
   private string $reservation_AdditionalNote = "";
   private int $reservation_restaurantId = 0;
   private string $reservation_FullName = "";
   private DateTime $reservation_DateTime;
   private bool $reservation_isActive;
    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId(): int{
        return $this->reservation_id;
    }
    public function getAmountAdults(): int{
        return $this->reservation_nrOfAdults;
    }
    public function getAmountKids(): int{
        return $this->reservation_nrOfKids;
    }
    public function getAdditionalNote(): string{
        return $this->reservation_AdditionalNote;
    }
    public function getRestaurantId(): int{
        return $this->reservation_restaurantId;
    }
    public function getName(): string{
        return $this->reservation_FullName;
    }
    public function getDateTime(): DateTime{
        return $this->reservation_DateTime;
    }
    public function getIsActive(): bool{
        return $this->reservation_isActive;
    }

    public function setId($reservationId){
        $this->reservation_id = $reservationId;
    }
    public function setAmountAdults($amountAdults){
        $this->reservation_nrOfAdults = $amountAdults;
    }
    public function setAmountKids($amountKids){
        $this->reservation_nrOfKids = $amountKids;
    }
    public function setAdditionalNote($note){
        $this->reservation_AdditionalNote = $note;
    }
    public function setRestaurantId($restaurantId){
        $this->reservation_restaurantId = $restaurantId;
    }
    public function setName($name){
      $this->reservation_FullName = $name;
    }
    public function setReservationDateTime($dateTime){
        $this->reservation_DateTime = $dateTime;
    }
    public function setIsActive($answer){
        $this->reservation_isActive = $answer;
    }
}