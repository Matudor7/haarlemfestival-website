<?php
require __DIR__ . '/../Repositories/festivalRepository.php';

class FestivalService{
    public function getFestival(){
        $festivalRepo = new FestivalRepository();
        $festival = $festivalRepo->getFestival();

        return $festival;
    }
}
?>