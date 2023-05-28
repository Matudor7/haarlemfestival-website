<?php
require_once ("../Models/Ticket.php");
require_once __DIR__. "/repository.php";
class TicketRepository extends Repository
{

    function getAllTickets()
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

    public function getTicketByID($id)
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

    public function insert($ticket)
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO ticket (quantity,	price,	dance_event_id,	yummy_event_id,	history_event_id,	access_pass_id,	status	)
VALUES (	?,	?,	?,	?,	?,	?,	?	)");
            $statement->execute(array(
                htmlspecialchars($ticket->getQuantity()),
                htmlspecialchars($ticket->getPrice()),
                htmlspecialchars($ticket->getDanceEventId()),
                htmlspecialchars($ticket->getYummyEventId()),
                htmlspecialchars($ticket->getHistoryEventId()),
                htmlspecialchars($ticket->getAccessPassId()),
                htmlspecialchars($ticket->getStatus())
            ));
            return $this->getTicketByID($this->connection->lastInsertId());

        } catch (PDOException $e) {
            echo $e;
        }


    }

    public function getAllTicket()
    {
    }

}