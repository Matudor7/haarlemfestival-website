<?php
require __DIR__ . '/../../Services/danceService.php';
require_once __DIR__ . '/../../Models/ArtistModel.php';

class DanceArtistsController{
    private $danceService;

    function __construct(){
        $this -> danceService = new DanceService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this -> danceService -> getAllArtistsWithoutMusicTypes());
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            $artistJsonString = file_get_contents('php://input');

            $danceArtistData = json_decode($artistJsonString, true);

            $danceArtist = new ArtistModel();
            
            try{            
            //Get image URL from POST request, then download that image into /media/dancePics
            $imageUrl = $_FILES['danceArtistImageInput']['tmp_name'];
            
            $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $danceArtistData['dance_artist_name'])));;

            $downloadPath ='/media/dancePics/' . $imageName . '.png'; // /media/dancePics/artistName.png

            //Put the file from the image path to the download path
            move_uploaded_file($imageUrl, SITE_ROOT . $downloadPath);
            }catch(Exception $e){
                echo $e->getMessage();
            }


            //TODO: complete the POST by filling all location variables in
            if ($danceArtistData['dance_artist_hasDetailPage'] == "Yes") {
                $hasDetailPage = true;
            } else {
                $hasDetailPage = false;
            }
            
            $danceArtist->setName($danceArtistData['dance_artist_name']);
            $danceArtist->setHasDetailPAge($hasDetailPage);
            $danceArtist->setArtistHomepageImageUrl($downloadPath);
            $this->danceService->insertArtist($danceArtist);
            
            
        }
                 
    }
}
?>