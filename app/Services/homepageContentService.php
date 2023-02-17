<?php
require __DIR__ . '/../Repositories/homepageContentRepository.php';

class HomepageContentService{
    public function getAll(){
        $homepageRepo = new homepageContentRepository();
        $homepageContents = $homepageRepo->getAll();

        return $homepageContents;
    }
}
?>