<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';
require __DIR__ . '/../services/eventService.php';

class AdminController extends Controller{
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
        //TODO: Use constructor to avoid duplicate code
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/admin/events.php';
    }
    function addevent(){
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
}

?>