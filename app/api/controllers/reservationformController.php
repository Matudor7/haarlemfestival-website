<?php
require __DIR__ . '/../../Services/productService.php';
require __DIR__ . '/../../Services/shoppingCartService.php';
require __DIR__ . '/../../Services/ReservationService.php';
require __DIR__ . '/../../Services/YummyService.php';
require_once __DIR__ . '/../../Models/productModel.php';
require_once __DIR__ . '/../../Models/ReservationModel.php';
class reservationformController
{
    private $productService;
    private $shoppingCartService;
    private $reservationService;
    private $yummyService;
    function __construct(){
        $this->productService = new ProductService();
        $this->shoppingCartService = new ShoppingCartService();
        $this->reservationService = new ReservationService();
        $this->yummyService = new YummyService();
    }

    public function selectTimeslot(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['productId'])){
                $productId = $data['productId'];

                $result = $this->productService->getById($productId);

                header('Content-Type: application/json;');
                echo json_encode($result);
            }  else {echo json_encode("does not work yet");}
        }
    }

    public function addToCart(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['timeslotId'])&isset($data['userId'])){
                $productId = 73;
                $userId = $data['userId'];
                $adultsAmount = $data['adultsAmount'];
                $kidsAmount = $data['kidsAmount'];
                $amount = $adultsAmount + $kidsAmount;
                $eventType = $data['eventType'];
                $note = $data['note'];
                $restaurantId = $data['restaurantId'];
                $timeslotId = $data['timeslotId'];
                $reservationName = $data['reservationName'];

                $selectedTimeSlot = $this->productService->getById($timeslotId);

                if ($this->checkAvailability($amount, $timeslotId)) {
                        $shoppingcartNote = $this->createReservation($adultsAmount, $kidsAmount, 20, $note, $restaurantId, $reservationName, $selectedTimeSlot->getStartTime());
                        $this->shoppingCartService->addProducts($userId, $productId, 1, $eventType, $shoppingcartNote);
                    $result = "Great! we have added ".$amount." seats for ".$selectedTimeSlot->getName()." at ".$selectedTimeSlot->getLocation()." on ".$this->formatDateTime($selectedTimeSlot->getStartTime())." to the shopping cart";
                } else{
                    $availability = $selectedTimeSlot->getAvailableSeats();
                    $result = "Oh No! we only have ".$availability." seats for ".$selectedTimeSlot->getName()." available";
                }
                header('Content-Type: application/json;');
                echo json_encode($result);

            }  else {echo json_encode("No reservation Selected!");}
        }
    }
private function createReservation($adults, $kids, $price, $note, $restaurantId, $name, $dateTime){
         $this->reservationService->addReservation($adults, $kids, $price, $note, $restaurantId, $name, $dateTime);
         $restaurant = $this->yummyService->getById($restaurantId);
         $totalPeople = $adults + $kids;

         return $result = "Dinner Reservation for: ".$name.". In ".$restaurant->getRestaurantName().
             " on ".$this->formatDateTime($dateTime).
             " for ".$totalPeople." People (".$adults." Adults + ".$kids." Kids). Note for Restaurant: ".
             $note;
}
    private function checkAvailability(int $amount, int $productId){
        $product = $this->productService->getById($productId);
        if ($amount <= $product->getAvailableSeats()){
            return true;
        }
        return false;
    }

    private function formatDateTime(string $dateTime){
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        return $date->format('dS M/Y @ H:i');
    }
}