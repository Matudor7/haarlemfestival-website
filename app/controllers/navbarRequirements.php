<?php
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/productService.php';
require __DIR__ . '/../Services/shoppingCartService.php';

$eventService = new EventService();
$events = $eventService->getAll();

$shoppingCartService = new ShoppingCartService();
$shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);

$productService = new ProductService();

//This causes every object to be its own array
$products = [];
foreach($shoppingCart->getProducts() as $product_id){
    array_push($products, $productService->getById($product_id));
}

//This merges all products to be in a single-level array
$merged_products = array_merge(...$products);

//"Amounts" will always be equal to the number of products in the array 
$amounts = [];
foreach($shoppingCart->getAmount() as $amount){
    array_push($amounts, $amount);
}

$totalPrice = 0;

for($i = 0; $i < count($merged_products); $i++){
    $totalPrice += ($merged_products[$i]->getPrice() * $amounts[$i]); 
}
?>