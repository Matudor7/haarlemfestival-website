<?php
require __DIR__ . '/../Repositories/ReservationRepository.php';
class ReservationService
{
    private $reservationRepo ;

    public function __construct() {
        $this->reservationRepo = new ReservationRepository();
    }

public function getReservationById($reservationId){
        return $this->reservationRepo->getReservationById($reservationId);
}
public function getAllReservations(){
        return $this->reservationRepo->getAllReservations();
}
public function addReservation($adults, $kids, $price, $note, $restaurantId, $name, $dateTime){
        $this->reservationRepo->addReservation($adults, $kids, $price, $note, $restaurantId, $name, $dateTime);
}
public function updateReservation(){

}
}