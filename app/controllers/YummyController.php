<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/YummyService.php';
require __DIR__ . '/../Services/RecipeService.php';

class YummyController extends Controller{


    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();
        

        $yummyService = new YummyService();
        $restaurants = $yummyService->getAllRestaurants();


        $recipeService = new RecipeService();
        $recipes = $recipeService->getAllRecipes();

        require __DIR__ . '/../views/yummy/index.php';

    }
    public function Specktakel() {
        $eventService = new EventService();
        $yummyService = new YummyService();
        $events = $eventService->getAll();
        require __DIR__ . '/../views/yummy/specktakel.php';
    }

}




    /*public function detail($restaurant_name) {
        $eventService = new EventService();
        $yummyService = new YummyService();
        try{
            $restaurant = $yummyService->getByName($restaurant_name);
           switch ($restaurant_name) {
          case Specktakel:
             require __DIR__ . '/../views/yummy/specktakel.php';
            break;
          case Mr and MRS:
               require __DIR__ . '/../views/yummy/MrAndMrs.php';
            break;

          default:
             require __DIR__ . '/../views/yummy/specktakel.php';
        }


        }catch (Exception $e) {
            echo $e;
        }
        $events = $eventService->getAll();
        }

}*/
?>