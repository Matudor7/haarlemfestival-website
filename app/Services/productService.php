<?php
//Tudor Nosca (678549)
require __DIR__ . '/../Repositories/productRepository.php';

class ProductService{
    public function getAll(){
        $productRepo = new ProductRepository();
        $products = $productRepo->getAll();

        return $products;
    }

    public function getById(int $id){
        $productRepo = new ProductRepository();
        $product = $productRepo->getById($id);
        
        return $product;
    }

    public function getByEventType($eventTypeId){
        $productRepo = new ProductRepository();
        return $productRepo->getByEventType($eventTypeId);
    }

    public function getProductNameById(int $id){
        $productRepo = new ProductRepository();
        return $productRepo ->getProductNameById($id);
    }
    public function updateProductAvailability($productId, $amount){
        $productRepo = new ProductRepository();
        $productRepo->updateProductAvailability($productId, $amount);
    }
}
?>