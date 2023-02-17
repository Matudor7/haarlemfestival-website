<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/homepageContentModel.php';

class homepageContentRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this -> connection -> prepare("SELECT");
        }
    }
}
?>