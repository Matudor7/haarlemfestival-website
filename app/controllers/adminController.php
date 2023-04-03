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
    private $userService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->danceService = new DanceService();
        $this->yummyService = new YummyService();
        $this->userService = new UserService();

        $this->events = $this->eventService->getAll();
    }

    public function index()
    {
        $festivalService = new FestivalService();
        $eventService = new EventService();

        $festival = $festivalService->getFestival();
        $events = $eventService->getAll();

        //This does not work as intended: changes all festival events at once
        if (isset($_POST['events'])) {
            $festivalEvent = $festival[0];
            $newEvent = $eventService->getByName($_POST['events']);
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


        }
    }

    public function editRestaurantPage()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();

        $yummyService = new YummyService();
        $restaurant = $yummyService->getById($_GET['id']);


        $foodTypeService = new FoodTypeService();
        $foodTypes = $foodTypeService->getAllFoodType();

        $ratingService = new RatingService();
        //$thisRestaurantRating = $ratingService->getAllRatingById($restaurant->getFoodType());
        $ratings = $ratingService->getAllRating();

        require __DIR__ . '/../views/admin/editRestaurantPage.php';
    }

    public function editRestaurant($restaurant)
    {
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
        require_once("../Views/registerUser.php");
        // Pass $userCreationMessage and $status variables to the view
        return [$userCreationMessage, $status];
    }

      /*  if ($result) {
            $_SESSION['userCreationMessage'] = "User created successfully!";
        } else {
            $_SESSION['userCreationMessage'] = "Username already exists, please choose a different one!";
        }

        $this->registerUserPage();
        unset($_SESSION['userCreationMessage']);*/
    
    

    
    // Administrator - Manage users - User CRUD. Includes search/filter and sorting. Must display registration date. 
    // done by: Betül Beril Dündar - 691136 
    function users(){            
        $searchString = "";
        $sortType = "";
        $filterType = "";

        if(isset($_GET["search"]) && !empty(trim($_GET["search"]))) { 
            $searchString = htmlspecialchars($_GET["search"], ENT_QUOTES, "UTF-8");
        }
        if(isset($_GET["sortBy"])) {
            $sortType = $_GET["sortBy"];
        }
        if(isset($_GET["filter"])) {
            $filterType = $_GET["filter"];
        }

        switch(true) { //searching, filtering and sorting
            case !empty($searchString): 
                $allUsers = $this->userService->getUsersBySearch($searchString);
                break;
            case ($sortType == 'laterRegistrationDate'):
                $allUsers = $this->userService->getAllUsersByLaterRegistrationDate(); 
                break;
            case ($sortType == 'usernameAlphabetical'):
                $allUsers = $this->userService->getAllUsersByUsrnameAlphabetical(); 
                break;
            case ($filterType == 'admins'):
                $allUsers = $this->userService->getAllAdminUsers(); 
                break;
            case ($filterType == 'employees'):
                $allUsers = $this->userService->getAllEmployeeUsers(); 
                break;
            case ($filterType == 'customers'):
                $allUsers = $this->userService->getAllCustomerUsers(); 
                break;
            default:
                $allUsers = $this->userService->getAllUsersFromDatabase(); 
                break;
        }
        require __DIR__ . "/../views/admin/users.php";
    }

    function addUser(){
        $userTypeService = new UserTypeService();        
        $allUserTypes = $userTypeService->getAllUserType();   
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user = new User();
            $user->setUserFirstName($_POST['userAdminFirstNameTextBox']);
            $user->setUserLastName($_POST['userAdminLastnameTextBox']);
            $user->setUserPassword($_POST['userAdminPasswordTextBox']);
            $user->setUsername($_POST['userAdminUsernameTextBox']);
            $user->setUserEmail($_POST['userAdminEmailTextBox']);
            $user->setUserTypeId($_POST['userAdminUserTypeDropdown']);

            $this->userService->createUser($user);
            header('Location: /admin/users');
       }

        require __DIR__ . "/../views/admin/addUser.php";
    }

    function createNewUser(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->addUser();
       } else {
            $user = new User();
            $user->setUserFirstName($_POST['userAdminFirstNameTextBox']);
            $user->setUserLastName($_POST['userAdminLastnameTextBox']);
            $user->setUserPassword($_POST['userAdminPasswordTextBox']);
            $user->setUsername($_POST['userAdminUsernameTextBox']);
            $user->setUserEmail($_POST['userAdminEmailTextBox']);
            $user->setUserTypeId($_POST['userAdminUserTypeDropdown']);

            $this->userService->createUser($user);
            header('Location: /admin/users');
       }
    }
          
    function editUser(){
        $userTypeService = new UserTypeService();        //TODO do ctor
        $allUserTypes = $userTypeService->getAllUserType();
        $userToEdit = $this->userService->getByID($_GET['id']); 
        require __DIR__ . "/../views/admin/editUser.php";
    } 

    function deleteUser(){
        $userToDelete = $this->userService->getByID($_GET['id']); 
        $this->userService->deleteUser($userToDelete);
        header('Location: /admin/users');
    }
}
?>