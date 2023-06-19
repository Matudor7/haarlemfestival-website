<?php
require_once("../Repositories/TicketRepository.php");
class TicketService
{
    public function getAllTickets()
    {
        $repository = new TicketRepository;
        $tickets = $repository->getAllTicket();
        return $ticket;
    }


    public function getByID($id)
    {
        $repository = new TicketRepository();
        $ticket = $repository->getTicketByID($id);
        return $ticket;
    }
    public function storeTicketDB($ticket)
    {
        $repository = new TicketRepository;

    //var_dump($repository->insert($ticket));
        return $repository->insert($ticket);

    }

}