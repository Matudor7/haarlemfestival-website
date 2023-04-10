<?php
session_start();
require __DIR__ . '/controller.php';
//require_once __DIR__ . '/../services/festivalService.php';
//require_once __DIR__ . '/../services/eventService.php';
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
    private $foodTypeService;
    private $ratingService;
    private $userTypeService;

    public function __construct()
    {
       // $this->eventService = new EventService();
        $this->danceService = new DanceService();
        $this->yummyService = new YummyService();
        $this->userService = new UserService();
        $this->foodTypeService = new FoodTypeService();
        $this->ratingService = new RatingService();
        $this->userTypeService = new userTypeService();

      //  $this->events = $this->eventService->getAll();
    }
    //Tudor Nosca (678549)
    public function index()
    {

        if($this->checkRole()) {   
        require_once __DIR__ . '/../Services/eventService.php';
        require_once __DIR__ . '/../Services/festivalService.php';

        $festivalService = new FestivalService();
        $eventsService = new EventService();

        $festival = $festivalService->getFestival();
        $events = $eventsService->getAll();

        if (isset($_POST['events'])) {
            $festivalEvent = $festival[0];
            $newEvent = $eventsService->getByName($_POST['events']);
            $festivalService->changeEvent($festivalEvent->getId(), $newEvent->getName(), $newEvent->getId(), $newEvent->getStartTime(), $newEvent->getEndTime());
            echo "Selected event is: " . $_POST['events'];
        }

        require __DIR__ . '/../views/admin/index.php';
    }
    else{
        header('Location: /');
    }
    }


    //Tudor Nosca (678549)
    public function events()
    {
        if($this->checkRole()) {
            require_once __DIR__ . '/../Services/eventService.php';
        
            $eventService = new EventService();
            $events = $eventService->getAll();
    
            require __DIR__ . '/../views/admin/events.php';
        }else{
            header('Location: /');
        }
    }
    //Tudor Nosca (678549)
    function addevent()
    {
        if($this->checkRole()) {
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
        else{
            header('Location: /');
        }
        
    }
    //Tudor Nosca (678549)
    function editevent()
    {
        if($this->checkRole()) {
            require __DIR__ . '/../Services/eventService.php';
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
        else{
            header('Location: /');
        }
    }
    //Tudor Nosca (678549)
    function deleteevent()
    {
        if($this->checkRole()) {
            require __DIR__ . '/../Services/eventService.php';

            $eventService = new EventService();
    
            $event = $eventService->getById($_GET['id']);
    
            $eventService->deleteEvent($event);
    
            header('Location: /admin/events');
        }
        else{
            header('Location: /');
        }
    }

    public function addRestaurantPage()
    {
        if($this->checkRole()) {
            //$events = $this->eventService->getAll();
            $foodTypes = $this->foodTypeService->getAllFoodType();
            $ratings = $this->ratingService->getAllRating();

            require __DIR__ . '/navbarRequirements.php';
            require __DIR__ . '/../views/admin/addRestaurantPage.php';
        }
        else{
            header('Location: /');
        }
    }

    public function manageRestaurants()
    {
        if($this->checkRole()) {
            //$events = $this->eventService->getAll();
            $restaurants = $this->yummyService->getAllRestaurants();
            $foodTypes = $this->foodTypeService->getAllFoodType();
            $ratings = $this->ratingService->getAllRating();

            require __DIR__ . '/navbarRequirements.php';
            require __DIR__ . '/../views/admin/manageRestaurants.php';
        } else {
            header('Location: /');
        }
    }

    private function getRestaurantPictureURL($restaurant_pictureURL, $restaurant_name)
    {
        $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $restaurant_name)));
        $downloadPath = '/media/yummyPics/' . $imageName . '.png';
        move_uploaded_file($restaurant_pictureURL, SITE_ROOT . $downloadPath);
        return $downloadPath;

    }

    public function addRestaurant()
    {
        if($this->checkRole()) {
            if (isset($_POST['addRestaurant'])) {
                try {
                    //Get image URL from POST request, then download that image into /media/events
                    $restaurant_pictureURL = $_FILES['restaurant_pictureURL']['tmp_name'];
                    $downloadPath = $this->getRestaurantPictureURL($restaurant_pictureURL, $_POST['restaurant_name']);
                    $restaurant = new RestaurantModel();
                    $restaurant->setRestaurantPictureURL($downloadPath);
    
    
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
    
                    //$restaurant->setRestaurantPictureURL($downloadPath);
                    $restaurantService = new YummyService();
                    $result = $restaurantService->insertRestaurant($restaurant);
    
                    if ($result){
                        header("location: /admin/manageRestaurants");
                        exit();
                    }
    
                } catch (Exception $e) {
                    echo "Error adding restaurant: " . $e->getMessage();
                }
            }
        }
        else{
            header('Location: /');
        }
    }

    public function editRestaurantPage()
    {
        if($this->checkRole()) {
            //$eventService = new EventService();
            //$events = $eventService->getAll();
            $restaurant = $this->yummyService->getById($_GET['id']);
            $foodTypes =  $this->foodTypeService->getAllFoodType();
            $ratings = $this->ratingService->getAllRating();

            require __DIR__ . '/navbarRequirements.php';
            require __DIR__ . '/../views/admin/editRestaurantPage.php';
        }
        else{
            header('Location: /');
        }
    }

    public function editRestaurant(){
        if($this->checkRole()) {
            $restaurant = new RestaurantModel();

        // Retrieve the restaurant object from the database
        $restaurantId = $_POST['restaurant_id'];
        $restaurantFromDB = $this->yummyService->getById($restaurantId);

        // Check if user uploaded a new picture URL or not
        if (!empty($_FILES['restaurant_pictureURL']['name'])) {
            $downloadPath = $this->getRestaurantPictureURL($_FILES['restaurant_pictureURL']['tmp_name'], $_POST['restaurant_name']);
            $restaurant->setRestaurantPictureURL($downloadPath);
        } else {
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
        else{
            header('Location: /');
        }
    }

    public function deleteRestaurantPage()
    {
        if($this->checkRole()) {
            $id = $_GET['id'];
            $this->yummyService->deleteRestaurant($id);
    
            $this->manageRestaurants();
        }
        else{
            header('Location: /');
        }
    }

    public function registerUserPage()
    {
        if($this->checkRole()) {
            //$eventService = new EventService();
            // $events = $eventService->getAll();

            $userTypes = $this->userService->getUserType();
            require __DIR__ . '/navbarRequirements.php';
            require_once __DIR__ . '/../views/registerUser.php';
        }
        else{
            header('Location: /');
        }
    }

    public function registerUser(){
        if($this->checkRole()) {
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
           if (isset($userCreationMessage)) {
               return [$userCreationMessage, $status];
           } else {
               return [null, null];
           }
        }
        else{
            header('Location: /');
        }
    }

    
    // Administrator - Manage users - User CRUD. Includes search/filter and sorting. Must display registration date. 
    // done by: Betül Beril Dündar - 691136 
    function users(){   
        if($this->checkRole()){
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
        require __DIR__ . "/../views/admin/users.php";}
        else{
            header('Location: /');
        }
    }

    function addUser(){
        if($this->checkRole()) {
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
        else{
            header('Location: /');
        }
    }
          
    function editUser(){
        if($this->checkRole()) {
           
            $allUserTypes = $this->userTypeService->getAllUserType();
            $userToEdit = $this->userService->getByID($_GET['id']); 
    
            if (isset($_POST['editbutton'])) {
                if(isset($_FILES['userAdminImageInput']) && $_FILES['userAdminImageInput']['error'] == 0){                
                        $imageUrl = $_FILES['userAdminImageInput']['tmp_name'];
                        $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['userAdminUsernameTextBox'])));
                        $downloadPath = SITE_ROOT . '/media/userProfilePictures/' . $imageName . '.png'; 
                        move_uploaded_file($imageUrl, $downloadPath);
                        $downloadPath = str_replace(SITE_ROOT, '', $downloadPath); // remove SITE_ROOT from $downloadPath       
                    
                }else{
                    $downloadPath = $userToEdit->getUserPicURL();
                }               
                
                $user = new User();
                $user->setUserFirstName($_POST['userAdminFirstNameTextBox']);
                $user->setUserLastName($_POST['userAdminLastnameTextBox']);
                $user->setUsername($_POST['userAdminUsernameTextBox']);
                $user->setUserEmail($_POST['userAdminEmailTextBox']);
                $user->setUserTypeId($_POST['userAdminUserTypeDropdown']);
                $user->setUserPicURL($downloadPath);
                $this->userService->updateUser($userToEdit, $user);   
            }  
            require __DIR__ . "/../views/admin/editUser.php";
        }
        else{
            header('Location: /');
        }
    } 

    function deleteUser(){
        if($this->checkRole()) {
            $userToDelete = $this->userService->getByID($_GET['id']); 
            $this->userService->deleteUser($userToDelete);
            header('Location: /admin/users');
        }
        else{
            header('Location: /');
        }
    }

    function checkRole(){
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2){
            return true;
        }
        return false;
    }
}
?>