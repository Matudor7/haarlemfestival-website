<?php 

require __DIR__ . '/Repositories/walkingTourRepository.php';
require __DIR__ . '/Models/walkingTourModel.php';

class WalkingTourService {

    private $walkingTourRepository;

    public function __construct() {
        $this->walkingTourRepository = new WalkingTourRepository();
    }

    public function getAllWalkingTours() {

        $walkingTours = $this->walkingTourRepository->getAllWalkingTours();

        return $walkingTours;
    }

    public function getWalkingTourById(int $id) {

        $walkingTour = $this->walkingTourRepository->getWalkingTourById($id);

        return $walkingTour;
    }

    public function getWalkingTourByLanguage(int $lanuageId) {

        $walkingTour = $this->walkingTourRepository->getWalkingTourByLanguage($lanuageId);

        return $walkingTour;
    }
}
?>