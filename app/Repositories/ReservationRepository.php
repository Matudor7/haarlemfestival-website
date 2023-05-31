<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/ReservationModel.php';
class ReservationRepository extends Repository
{
public function getReservationById($reservationId){
    $query = "SELECT reservation_id, reservation_nrOfAdults, reservation_nrOfKids, 
       reservation_totalPrice, reservation_AdditionalNote, reservation_restaurantId, 
       reservation_FullName, reservation_DateTime FROM dinner_reservation WHERE reservation_id = :reservationId";

    try{
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':reservationId', $reservationId);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $reservation = new Reservation();
            $reservation->setId($row['reservation_id']);
            $reservation->setAmountAdults($row['reservation_nrOfAdults']);
            $reservation->setAmountKids($row['reservation_nrOfKids']);
            $reservation->setTotalPrice($row['reservation_totalPrice']);
            $reservation->setAdditionalNote($row['reservation_AdditionalNote']);
            $reservation->setRestaurantId($row['reservation_restaurantId']);
            $reservation->setName($row['reservation_FullName']);
            $dateTimeString = $row['reservation_DateTime'];
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString);
            $reservation->setDateTime($dateTime);
        }

        return $reservation;

    }catch(PDOException $e){echo $e;}

}
public function getAllReservations(){
    $query = "SELECT reservation_id FROM dinner_reservation";

    try{
        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $reservations[] = $this->getReservationById($row['reservation_id']);
        }

        return $reservations;

    }catch(PDOException $e){echo $e;}
}
public function addReservation($adults, $kids, $price, $note, $restaurantId, $name, $dateTime){
    $query = "INSERT INTO dinner_reservation (reservation_nrOfAdults, reservation_nrOfKids,
                                reservation_totalPrice, reservation_AdditionalNote, reservation_restaurantId,
                                reservation_FullName, reservation_DateTime) 
                    VALUES (?,?,?,?,?,?,?)";
    try {
        $statement = $this->connection->prepare($query);
        $statement->execute(array($adults, $kids, $price, htmlspecialchars($note),
            $restaurantId, htmlspecialchars($name), $dateTime));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function updateReservation($reservationId){

}
}