<?php
require __DIR__ . '/../Repositories/OrderRepository.php';
class OrderService
{
    public function getAll()
    {
        $orderRepo = new OrderRepository();
        $orders = $orderRepo->getAll();
        return $orders;
    }

    public function getOrderByID($id)
    {
        $orderRepo = new OrderRepository();
        $order = $orderRepo->getById($id);
        return $order;
    }
}