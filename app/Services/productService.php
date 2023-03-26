<?php
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
}
?>