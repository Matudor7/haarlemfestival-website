<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
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

    public function index()
    {

        $eventService = new EventService();
        $events = $eventService->getAll();


        $yummyService = new YummyService();
        $restaurants = $yummyService->getAllRestaurants();


        $recipeService = new RecipeService();
        $recipes = $recipeService->getAllRecipes();

        require __DIR__ . '/../views/yummy/index.php';

    }
    // echo $_SERVER['REQUEST_METHOD'];

    public function detail(){
        $eventService = new EventService();
        $events = $eventService->getAll();
        $yummyService = new YummyService();
        $restaurant_id = $_GET['restaurant_id'];
        $contactInfService = new ContactInfService();

        try {
            $restaurant = $yummyService->getById($restaurant_id);

            $address_id = $restaurant->getRestaurantAddressId();
            $addressService = new AddressService();
            $address = $addressService->getById($address_id);
            $contact = $contactInfService->getById($restaurant->getContactInfId());

            if($restaurant->getHavaDetailPageOrNot()){
                $yummyDetailPageService = new YummyDetailPageService();
                $html =  $yummyDetailPageService->getContentById($restaurant->getDetailId());

                require __DIR__ . '/../views/yummy/detailPage.php';
            }else{
                $yummyDetailPageService = new YummyDetailPageService();
                $html =  $yummyDetailPageService->getContentById($restaurant->getDetailId());
                $_SESSION['noDetailPageMessage'] = "We are sorry to inform you that we don't have this detail page for now.
                 Please check out our other pages and have fun in the festival!";

                require __DIR__ . '/../views/yummy/detailPage.php';
            }
        } catch (Exception $e) {echo $e;}
    }

}
?>