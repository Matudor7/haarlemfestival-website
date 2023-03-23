<?php 
class TourLocation {
    private int $walkingTour_Locations_id = 0;
    private string $walkingTour_Locations_venueName = "";
    private int $walkingTour_Locations_addresId = 0;

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
}
?>