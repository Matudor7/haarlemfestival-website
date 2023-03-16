<?php 

require __DIR__ . '/Repositories/walkingTourRepository.php';

class WalkingTourService {
    public function getAllWalkingTours() {
        $walkingTourRepo = new WalkingTourRepository();
        $walkingTours = $walkingTourRepo->getAllWalkingTours();

        return $walkingTours;
    }
}
?>