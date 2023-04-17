<?php
//Tudor Nosca (678549)
require_once __DIR__ . '/../Services/eventService.php';
require_once __DIR__ . '/../Services/productService.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/festivalService.php';
require_once __DIR__ . '/../Services/vatService.php';
require_once __DIR__ . '/../Models/festivalModel.php';
require_once __DIR__ . '/../Models/vatModel.php';

$festivalService = new FestivalService();
$festival = $festivalService->getFestival();

$eventService = new EventService();

$shoppingCartService = new ShoppingCartService();
$shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);

$productService = new ProductService();

$vatService = new VatService();
$vat = $vatService->getVat();

$events = [];

foreach($festival as $f){
    array_push($events, $eventService->getByName($f->getEventName()));
}

//This causes every object to be its own array
$products = [];
foreach($shoppingCart->getProducts() as $product_id){
    array_push($products, $productService->getById($product_id));
}

//This merges all products to be in a single-level array
$merged_products = array_merge($products);

//"Amounts" will always be equal to the number of products in the array 
$amounts = [];
foreach($shoppingCart->getAmount() as $amount){
    array_push($amounts, $amount);
}

$totalPrice = 0;

for($i = 0; $i < count($merged_products); $i++){
    $totalPrice += ($merged_products[$i]->getPrice() * $amounts[$i]); 
}

$additionalVat = $totalPrice * ($vat->getAmount() / 100);

$totalPrice += $additionalVat;

$hashedUserId = password_hash($_SESSION['user_id'], PASSWORD_DEFAULT);

?>