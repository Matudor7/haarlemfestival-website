<?php
session_start();
require __DIR__ . '/controller.php';
//require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/YummyService.php';
require __DIR__ . '/../Services/RecipeService.php';
require __DIR__ . '/../Services/AddressService.php';
require_once __DIR__ . '/../Models/RestaurantModel.php';
require_once __DIR__ . '/../Models/Address.php';
require __DIR__ . '/../Services/YummyDetailPageService.php';
require_once __DIR__ . '/../Models/YummyDetailPageModel.php';
require __DIR__ . '/../Services/ContactInfService.php';
require_once __DIR__ .'/../Models/ContactInf.php';



class YummyController extends Controller
{
    private $eventService;
    private $yummyService;
    private $recipeService;
    private $yummyDetailPageService;

    public function __construct() {
       // $this->eventService = new EventService();
        $this->yummyService = new YummyService();
        $this->recipeService = new RecipeService();
    }

    public function index()
    {
       // $events = $this->eventService->getAll();
        $restaurants = $this->yummyService->getAllRestaurants();
        $recipes = $this->recipeService->getAllRecipes();

        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/yummy/index.php';

    }
    // echo $_SERVER['REQUEST_METHOD'];

    private function getProducts(){
        require_once __DIR__ . '/../Services/productService.php';
        require_once __DIR__ . '/../Services/eventService.php';
        $productService = new ProductService();
        $eventService = new EventService();
        $thisEvent = $eventService->getByName("Yummy!");
        $tickets = $productService->getByEventType($thisEvent->getId());
        //Ale added a return here to be able to call it from the detail method
        return array('thisEvent' => $thisEvent, 'tickets' => $tickets);
    }

    public function detail(){
        $restaurant_id = $_GET['restaurant_id'];
        $contactInfService = new ContactInfService();
        $yummyDetailPageService = new YummyDetailPageService();

        //Andy's addition
        list('thisEvent' => $thisEvent, 'tickets' => $tickets) = $this->getProducts();

        try {
            $restaurant = $this->yummyService->getById($restaurant_id);

            if($restaurant->getHavaDetailPageOrNot()){
                $address_id = $restaurant->getRestaurantAddressId();
                $addressService = new AddressService();
                $address = $addressService->getById($address_id);
                $contact = $contactInfService->getById($restaurant->getContactInfId());
                $html =  $yummyDetailPageService->getContentById($restaurant->getDetailId());
                require_once __DIR__ . '/navbarRequirements.php';
                require __DIR__ . '/../views/yummy/detailPage.php';
            }else{
                $html =  $yummyDetailPageService->getContentById($restaurant->getDetailId());
                $_SESSION['noDetailPageMessage'] = "We are sorry to inform you that we don't have this detail page for now.
                 Please check out our other pages and have fun in the festival!";

                require_once __DIR__ . '/navbarRequirements.php';
                require __DIR__ . '/../views/yummy/detailPage.php';
            }
        } catch (Exception $e) {echo $e;}

        require __DIR__ .'/../views/reservationForm.php';
    }
}
?>