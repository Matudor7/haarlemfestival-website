<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';
require __DIR__ . '/../services/eventService.php';
require __DIR__ . '/../services/DanceService.php';
require __DIR__ . '/../Services/FoodTypeService.php';
require __DIR__ . '/../Services/RatingService.php';
require __DIR__ . '/../Services/YummyService.php';
require __DIR__ . '/../Services/UserService.php';


class AdminController extends Controller{
    private $eventService;
    private $danceService;
    private $events;
    private $yummyService;

    public function __construct() {
        $this->eventService = new EventService();
        $this->danceService = new DanceService();
        $this->yummyService = new YummyService();

        $this->events = $this->eventService->getAll();
    }
    public function index(){
        $festivalService = new FestivalService();
        $eventService = new EventService();

        $festival = $festivalService->getFestival();
        $events = $eventService->getAll();
        
        //This does not work as intended: changes all festival events at once
        if(isset($_POST['events'])){
            $festivalEvent = $festival[0];
            $newEvent = $eventService->getByName($_POST['events']);
            $festivalService->changeEvent($newEvent ->getName(), $festivalEvent->getEventName(), $newEvent->getId());
            echo "Selected event is: " . $_POST['events'];
        }
        
        require __DIR__ . '/../views/admin/index.php';
    }

    public function events(){
        $events = $this->eventService->getAll();

        require __DIR__ . '/../views/admin/events.php';
    }
    function addevent(){
        if(isset($_POST['addbutton'])){
            try{
            
                //Get image URL from POST request, then download that image into /media/events
                $imageUrl = $_FILES['eventinput']['tmp_name'];
                
                $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['eventnametextbox'])));;
    
                $downloadPath = SITE_ROOT . '/media/events/' . $imageName . '.png'; // public/media/events/event.png
    
                //Put the file from the image path to the download path
                move_uploaded_file($imageUrl, $downloadPath);
                }catch(Exception $e){
                    echo $e->getMessage();
                }
        }
        require __DIR__ . '/../views/admin/addevent.php';
    }

    function editevent(){
        $eventService = new EventService();

        $event = $eventService->getById($_GET['id']);

        if(isset($_POST['editbutton'])){
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

    function deleteevent(){
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
        $eventService = new EventService();
        $events = $eventService->getAll();

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


            }}
    public function editRestaurantPage()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        $yummyService = new YummyService();
        $restaurant =  $yummyService->getById($_GET['id']);


        $foodTypeService = new FoodTypeService();
        $foodTypes = $foodTypeService->getAllFoodType();

        $ratingService = new RatingService();
        $ratings = $ratingService->getAllRating();

        require __DIR__ . '/../views/admin/editRestaurantPage.php';
    }
    public function editRestaurant($restaurant){
        /* if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['dateOfAppointment']) && !empty($_POST['startingTime']) && !empty($_POST['employee']) && !empty($_POST['service'])) {
             require_once("../Model/Appointment.php");
             $appointment = new Appointment();

             $updatedCustomerName = htmlspecialchars($_POST["name"]);
             $updatedEmail = htmlspecialchars($_POST["email"]);
             $updatedDateOfAppointment = htmlspecialchars($_POST["dateOfAppointment"]);
             $updatedStartingTime = htmlspecialchars($_POST["startingTime"]);
             $updatedEmployeeId = htmlspecialchars($_POST['employee']);
             $updatedProductID = htmlspecialchars($_POST['service']);

             $appointment->customerName = $updatedCustomerName;
             $appointment->email = $updatedEmail;
             $appointment->dateOfAppointment = $updatedDateOfAppointment;
             $appointment->startingTime = $updatedStartingTime;
             $appointment->employeeId = $updatedEmployeeId;
             $appointment->productID = $updatedProductID;
             $appointment->id = $_POST['id'];
             require_once("../Service/AppointmentService.php");
             $appointmentService = new AppointmentService();
             $appointmentService->updateAppointment($appointment);
         }*/
    }
    public function deleteRestaurantPage(){
        $id = $_GET['id'];
        $this->yummyService->deleteRestaurant($id);

        $this->manageRestaurants();

    }


    public function RegisterNewUser(){
        /*
            $user = new User();
            $user->username = $_POST['firstname'];
            $user->userPicURL = $_POST['lastname'];
            $user->user_firstName = $_POST['password'];
            $user->username = $_POST['username'];
            require_once("../Service/AdminService.php");
            $adminService = new AdminService();
            $adminService->createUser($user);*/
    }


    /*username
     userPicURL
     user_firstName
 user_lastName
 user_email
     user_password
 user_userType
 */

}

?>
