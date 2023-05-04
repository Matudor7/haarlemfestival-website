<?php
require_once ("../Models/Ticket.php");
require_once ("repository.php");
class TicketRepository extends Repository
{

    public function __construct()
    {

    }
    function getAllUsers()
    {
        try {
            $statement = $this->connection->prepare("SELECT  id,	quantity,	price,	dance_event_id,	yummy_event_id,	history_event_id,	access_pass_id,	status	
FROM ticket");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $tickets = $statement->fetchAll();

            return $tickets;
        } catch (PDOException $e) {
            echo $e;
        }

    }

    public function getUserByID($id)
    {
        try {

            $stmt = $this->connection->prepare("SELECT  id,	quantity,	price,	dance_event_id,	yummy_event_id,	history_event_id,	access_pass_id,	status	
FROM ticket WHERE id=:id ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }

    }

}