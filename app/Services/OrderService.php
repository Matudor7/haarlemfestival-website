<?php
require __DIR__ . '/../Repositories/OrderRepository.php';
class OrderService
{
    private $all;

    public function getAll()
    {
        $orderRepo = new OrderRepository();
        $this->all = $orderRepo->getAll();
        $orders = $this->all;
        return $orders;
    }

    public function getOrderByID($id)
    {
        $orderRepo = new OrderRepository();
        $order = $orderRepo->getById($id);
        return $order;
    }
    public function insertOrder($order){
        $orderRepo = new OrderRepository();
        $order = $orderRepo->insertOrder($order);
        return $order;
    }


    public function changePaymentStatus($order_id, $payment_status){
       $orderRepo = new OrderRepository();
        $orderRepo->changePaymentStatus($order_id, $payment_status);
    }

}