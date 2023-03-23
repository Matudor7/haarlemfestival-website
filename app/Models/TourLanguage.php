<?php
/**enum TourLanguage: int
{
   case English = 1;
    case Dutch = 2;
    case Chinese = 3;
}**/
class TourLanguage{
    private int $walkingTour_Language_id;
    private string $walkingTour_Language_language;

    //setters
    public function setTourLanguageId(int $id){
        $this->walkingTour_Language_id = $id;
    }
    public function setTourLanguage(string $language){
        $this->walkingTour_Language_language = $language;
    }
    //getters
    public function getTourLanguageId(){
        return $this->walkingTour_Language_id;
    }
    public function getTourLanguage(){
        return $this->walkingTour_Language_language;
    }
}
?>