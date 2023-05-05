<?php 
class TourLocation {
    private int $walkingTour_Locations_id = 0;
    private string $walkingTour_Locations_venueName = "";
    private int $walkingTour_Locations_addresId = 0;
    private string $walkingTour_Location_url = "";

    //getters
    public function getLocationId(): int{
    return $this->walkingTour_Locations_id;
    }
    public function getLocationName(): string{
        return $this->walkingTour_Locations_venueName;
    }
    public function getLocationAddress(): int{
        return $this->walkingTour_Locations_addresId;
    }
    public function getLocationUrl(): string{
        return $this->walkingTour_Location_url;
    }

    //setters
    public function setLocationId(int $id): self
    {
        $this->walkingTour_Locations_id = $id;
        return $this;
    }
    public function setLocationName(string $name): self{
        $this->walkingTour_Locations_venueName = $name;
        return $this;
    }
    public function setLocationAddresss(int $address): self{
        $this->walkingTour_Locations_addresId = $address;
        return $this;
    }
    public function setLocationUrl(string $url){
        $this->walkingTour_Location_url = $url;
    }
}
?>