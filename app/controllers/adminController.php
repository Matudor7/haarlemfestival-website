<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';
require __DIR__ . '/../services/eventService.php';
require __DIR__ . '/../services/DanceService.php';
require __DIR__ . '/../Services/FoodTypeService.php';
require __DIR__ . '/../Services/RatingService.php';
require __DIR__ . '/../Services/YummyService.php';
require __DIR__ . '/../Services/UserService.php';
require __DIR__ . '/../Services/UserTypeService.php';


class AdminController extends Controller
{
    private $eventService;
    private $danceService;
    private $events;
    private $yummyService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->danceService = new DanceService();
        $this->yummyService = new YummyService();

        $this->events = $this->eventService->getAll();
    }

    public function index()
    {
        $festivalService = new FestivalService();

        $festival = $festivalService->getFestival();
        $events = $this->eventService->getAll();

        //This does not work as intended: changes all festival events at once
        if (isset($_POST['events'])) {
            $festivalEvent = $festival[0];
            $newEvent = $this->eventService->getByName($_POST['events']);
            $festivalService->changeEvent($newEvent->getName(), $festivalEvent->getEventName(), $newEvent->getId());
            echo "Selected event is: " . $_POST['events'];
        }

        require __DIR__ . '/../views/admin/index.php';
    }

    public function events()
    {
        //TODO: Use constructor to avoid duplicate code
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/admin/events.php';
    }

    function addevent()
    {
        if (isset($_POST['addbutton'])) {
            try {

                //Get image URL from POST request, then download that image into /media/events
                $imageUrl = $_FILES['eventinput']['tmp_name'];

                $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['eventnametextbox'])));;

                $downloadPath = SITE_ROOT . '/media/events/' . $imageName . '.png'; // public/media/events/event.png

                //Put the file from the image path to the download path
                move_uploaded_file($imageUrl, $downloadPath);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        require __DIR__ . '/../views/admin/addevent.php';
    }

    function editevent()
    {
        $eventService = new EventService();

        $event = $eventService->getById($_GET['id']);

        if (isset($_POST['editbutton'])) {
            $changedEvent = new Event();

            $changedEvent->setName($_POST['eventnametextbox']);
            $changedEvent->setDescription($_POST['eventdesctextbox']);
            $changedEvent->setStartTime($_POST['eventstarttimecalendar']);
            $changedEvent->setEndTime($_POST['eventendtimecalendar']);
            $changedEvent->setUrlRedirect("/" . strtolower(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['eventnametextbox'])));
            $changedEvent->setImageUrl($_POST['eventinput']);

            $eventService->updateEvent($event, $changedEvent);

            $event = $eventService->getById($_GET['id']);
        }

        require __DIR__ . '/../views/admin/editevent.php';
    }

    function deleteevent()
    {
        $eventService = new EventService();

        $event = $eventService->getById($_GET['id']);

        $eventService->deleteEvent($event);

        header('Location: /admin/events');
    }

    public function addRestaurantPage()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        $foodTypeService = new FoodTypeService();
        $foodTypes = $foodTypeService->getAllFoodType();

        $ratingService = new RatingService();
        $ratings = $ratingService->getAllRating();

        require __DIR__ . '/../views/admin/addRestaurantPage.php';
    }

    public function manageRestaurants()
    {
        $events = $this->eventService->getAll();

        $yummyService = new YummyService();
        $restaurants = $yummyService->getAllRestaurants();

        $foodTypeService = new FoodTypeService();
        $foodTypes = $foodTypeService->getAllFoodType();

        $ratingService = new RatingService();
        $ratings = $ratingService->getAllRating();


        require __DIR__ . '/../views/admin/manageRestaurants.php';
    }

    public function addRestaurant()
    {
        if (isset($_POST['addRestaurant'])) {
            try {

                //Get image URL from POST request, then download that image into /media/events
                $restaurant_pictureURL = $_FILES['restaurant_pictureURL']['tmp_name'];

                $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['restaurant_name'])));

                $downloadPath = '/media/yummyPics/' . $imageName . '.png'; // /media/yummyPics/restaurant.png

                //Put the file from the image path to the download path
                move_uploaded_file($restaurant_pictureURL, SITE_ROOT . $downloadPath);
                $restaurant = new RestaurantModel();
                $restaurant->setRestaurantName(htmlspecialchars($_POST['restaurant_name']));
                $restaurant->setFoodTypeId(htmlspecialchars($_POST['restaurant_foodType']));
                $restaurant->setRestaurantRatingId(htmlspecialchars($_POST['restaurant_rating']));
                $restaurant->setRestaurantKidsPrice(htmlspecialchars($_POST['restaurant_kidsPrice']));
                $restaurant->setRestaurantAdultsPrice(htmlspecialchars($_POST['restaurant_adultsPrice']));
                $restaurant->setDuration(htmlspecialchars($_POST['duration']));
                $restaurant->setHavaDetailPageOrNot(htmlspecialchars($_POST['haveDetailPage']));
                $restaurant->setRestaurantOpeningTime(htmlspecialchars($_POST['opening_time']));
                $restaurant->setNumberOfTimeSlots(htmlspecialchars($_POST['numTime_slots']));
                $restaurant->setRestaurantNumberOfAvailableSeats(htmlspecialchars($_POST['num_seats']));

                $restaurant->setRestaurantPictureURL($downloadPath);
                $restaurantService = new YummyService();
                $restaurantService->insertRestaurant($restaurant);

            } catch (Exception $e) {
                echo $e;
            }


        }
    }

    public function editRestaurantPage()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        $restaurant = $this->yummyService->getById($_GET['id']);


        $foodTypeService = new FoodTypeService();
        $foodTypes = $foodTypeService->getAllFoodType();

        $ratingService = new RatingService();
        //$thisRestaurantRating = $ratingService->getAllRatingById($restaurant->getFoodType());
        $ratings = $ratingService->getAllRating();

        require __DIR__ . '/../views/admin/editRestaurantPage.php';
    }

    public function editRestaurant(){
        $restaurant = new RestaurantModel();

        // Retrieve the restaurant object from the database
        $restaurantId = $_POST['restaurant_id'];
        $restaurantFromDB = $this->yummyService->getById($restaurantId);

        // Check if user uploaded a new picture URL or not
        if (!empty($_FILES['restaurant_pictureURL']['name'])) {
            // Upload the new picture and set the picture URL
            $restaurant_pictureURL = $_FILES['restaurant_pictureURL']['tmp_name'];
            $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['restaurant_name'])));
            $downloadPath = '/media/yummyPics/' . $imageName . '.png'; // /media/yummyPics/restaurant.png
            move_uploaded_file($restaurant_pictureURL, SITE_ROOT . $downloadPath);
            $restaurant->setRestaurantPictureURL($downloadPath);
        }
        else {
            // User did not upload a new picture, keep the one that is saved in the database
            $restaurant->setRestaurantPictureURL($restaurantFromDB->getRestaurantPictureURL());
        }

        // Update the existing restaurant object retrieved from the database
        $restaurant->setRestaurantId($_POST['restaurant_id']);
        $restaurant->setRestaurantName(htmlspecialchars($_POST['restaurant_name']));
        $restaurant->setFoodTypeId(htmlspecialchars($_POST['restaurant_foodType']));
        $restaurant->setRestaurantRatingId(htmlspecialchars($_POST['restaurant_rating']));
        $restaurant->setRestaurantKidsPrice(htmlspecialchars($_POST['restaurant_kidsPrice']));
        $restaurant->setRestaurantAdultsPrice(htmlspecialchars($_POST['restaurant_adultsPrice']));
        $restaurant->setDuration(htmlspecialchars($_POST['duration']));
        $restaurant->setHavaDetailPageOrNot(htmlspecialchars($_POST['haveDetailPage']));
        $restaurant->setRestaurantOpeningTime(htmlspecialchars($_POST['opening_time']));
        $restaurant->setNumberOfTimeSlots(htmlspecialchars($_POST['numTime_slots']));
        $restaurant->setRestaurantNumberOfAvailableSeats(htmlspecialchars($_POST['num_seats']));

        try {
            $result = $this->yummyService->updateRestaurant($restaurant);
            if ($result){
                header("location: /admin/manageRestaurants");
                exit();
            }
        } catch (Exception $e) {
            echo "Error updating restaurant: " . $e->getMessage();
        }
    }

    public function deleteRestaurantPage()
    {
        $id = $_GET['id'];
        $this->yummyService->deleteRestaurant($id);

        $this->manageRestaurants();
    }

    public function registerUserPage()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        $userService = new UserTypeService();
        $userTypes = $userService->getAllUserType();
        require_once __DIR__ . '/../views/registerUser.php';
    }

    public function registerUser(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
             $this->registerUserPage();
        } else {
            $user = new User();
            $user->setUserFirstName($_POST['firstname']);
            $user->setUserLastName($_POST['lastname']);
            $user->setUserPassword($_POST['password']);
            $user->setUsername($_POST['username']);
            $user->setUserEmail($_POST['email']);
            $user->setUserTypeId($_POST['userType']);
            $userService = new UserService();
            // $result = $userService->createUser($user);

            if ($userService->createUser($user)) {
                $userCreationMessage = "User created successfully!!!!";
                $status = "success";
            } else {
                $userCreationMessage = "User was not created, please try again!";
                $status = "danger";
            }
        }
        $this->registerUserPage();
        return [$userCreationMessage, $status];
    }

      /*  if ($result) {
            $_SESSION['userCreationMessage'] = "User created successfully!";
        } else {
            $_SESSION['userCreationMessage'] = "Username already exists, please choose a different one!";
        }

        $this->registerUserPage();
        unset($_SESSION['userCreationMessage']);*/
}
?>
