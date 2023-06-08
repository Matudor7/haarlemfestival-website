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
public function createReservation($id,$adults, $kids, $note, $restaurantId, $name, $dateTime){
        $this->reservationRepo->createReservation($id,$adults, $kids, $note, $restaurantId, $name, $dateTime);
}
public function updateReservation($reservationId, $nameInput, $date, $amountAdults, $amountKids, $guestNoteInput, $restaurantId, $status){
        $this->reservationRepo->updateReservation($reservationId, $nameInput, $date, $amountAdults, $amountKids, $guestNoteInput, $restaurantId, $status);
}
public function changeReservationStatus($reservationId, $reservationStatus){
        $this->reservationRepo->ChangeReservationStatus($reservationId, $reservationStatus);
}
}