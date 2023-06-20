<?php
require_once __DIR__ . '/../Repositories/OrderedProductsRepository.php';
class OrderedProductsService
{
    public function getAll(){
        $orderedProductsRepository = new OrderedProductsRepository();
        $orderedProducts = $orderedProductsRepository->getAll();
        return $orderedProducts;
    }
    public function getByOrderId(int $orderId){
        $orderedProductsRepository = new OrderedProductsRepository();
        $orderedProducts = $orderedProductsRepository->getByOrderId($orderId);
        return $orderedProducts;
    }
    public function addOrderedProduct(int $productId, int $orderId, int $amount){
        $orderedProductsRepository = new OrderedProductsRepository();
        $orderedProducts = $orderedProductsRepository->addOrderedProduct($productId, $orderId, $amount);
        return $orderedProducts;
    }
}