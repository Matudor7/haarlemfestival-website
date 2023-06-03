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
        $repository = new TicketRepository;
        $ticket = $repository->getTicketByID();
        return $ticket;
    }
    public function storeTicketDB($ticket)
    {
        $repository = new TicketRepository;
        return $repository->insert($ticket);

    }

}