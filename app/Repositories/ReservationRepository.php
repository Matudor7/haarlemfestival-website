<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/ReservationModel.php';
class ReservationRepository extends Repository
{
public function getReservationById($reservationId){
    $query = "SELECT reservation_id, reservation_nrOfAdults, reservation_nrOfKids, 
       reservation_AdditionalNote, reservation_restaurantId, 
       reservation_FullName, reservation_DateTime, reservation_status FROM dinner_reservation WHERE reservation_id = :reservationId";

    try{
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':reservationId', $reservationId);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $reservation = new Reservation();
            $reservation->setId($row['reservation_id']);
            $reservation->setAmountAdults($row['reservation_nrOfAdults']);
            $reservation->setAmountKids($row['reservation_nrOfKids']);
            $aditionalNote = htmlspecialchars_decode($row['reservation_AdditionalNote']);
            $reservation->setAdditionalNote($aditionalNote);
            $reservation->setRestaurantId($row['reservation_restaurantId']);
            $name = htmlspecialchars_decode($row['reservation_FullName']);
            $reservation->setName($name);
            $dateTimeString = $row['reservation_DateTime'];
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString);
            $reservation->setReservationDateTime($dateTime);
            $reservation->setReservationStatus($row['reservation_status']);
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
public function createReservation($adults, $kids, $note, $restaurantId, $name, $dateTime){
    $query = "INSERT INTO dinner_reservation (reservation_nrOfAdults, reservation_nrOfKids,
                                 reservation_AdditionalNote, reservation_restaurantId,
                                reservation_FullName, reservation_DateTime, reservation_status) 
                    VALUES (?,?,?,?,?,?,?)";
    try {
        $statement = $this->connection->prepare($query);
        $statement->execute(array($adults, $kids, htmlspecialchars($note),
            $restaurantId, htmlspecialchars($name), $dateTime, 2));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function updateReservation($reservationId, $nameInput, $date, $amountAdults, $amountKids, $guestNoteInput, $restaurantId, $status){
$query = "UPDATE dinner_reservation SET reservation_nrOfAdults= :adults , reservation_nrOfKids= :kids , reservation_AdditionalNote= :guestNote
                            ,reservation_restaurantId= :restaurantId , reservation_FullName= :name , reservation_DateTime= :date
                            , reservation_status= :status WHERE reservation_id= :id";
    try{
        $statement = $this->connection->prepare($query);
        $name = htmlspecialchars($nameInput);
        $guestNote = htmlspecialchars($guestNoteInput);

        $statement->bindParam(':id', $reservationId, PDO::PARAM_INT);
        $statement->bindParam(':adults', $amountAdults, PDO::PARAM_INT);
        $statement->bindParam(':kids', $amountKids, PDO::PARAM_INT);
        $statement->bindParam(':guestNote', $guestNote);
        $statement->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
        $statement->bindParam(':status', $status, PDO::PARAM_INT);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':name', $name);

        $statement->execute();
    } catch (PDOException $e){
        echo " We apologize, It wasn't possible to update this reservation. Review all the information and contact the Service Desk if the issue persists. Message: ".$e->getMessage();
    }
}
public function ChangeReservationStatus($reservationId, $reservationStatus){
    $query = "UPDATE dinner_reservation SET reservation_status= :status WHERE reservation_id= :id";

    try{
        $statement = $this->connection->prepare($query);

        $statement->bindParam(':id', $reservationId, PDO::PARAM_INT);
        $statement->bindParam(':status', $reservationStatus, PDO::PARAM_INT);
        $statement->execute();

    } catch (PDOException $e){
        echo " We apologize, It wasn't possible to change the status of this reservation. Refresh the page and try again, If the issue persists please contact the Service Desk. Message: ".$e->getMessage();
    }
}
}