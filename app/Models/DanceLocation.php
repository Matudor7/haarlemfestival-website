<?php

class DanceLocation {
    private int $dance_location_id = 0;
    private string $dance_location_name = ""; 
    private string $dance_location_street = ""; 
    private int $dance_location_number = 0;
    private string $dance_location_postcode = ""; 
    private string $dance_location_city = ""; 
    private string $dance_location_urlToTheirSite = "";
    private string $dance_location_imageUrl = ""; 

    // getters
    public function getDanceLocationId(): int {
        return $this->dance_location_id;
    }

    public function getDanceLocationName(): string {
        return $this->dance_location_name;
    }

    public function getDanceLocationStreet(): string {
        return $this->dance_location_street;
    }

    public function getDanceLocationNumber(): int {
        return $this->dance_location_number;
    }

    public function getDanceLocationPostcode(): string {
        return $this->dance_location_postcode;
    }

    public function getDanceLocationCity(): string {
        return $this->dance_location_city;
    }

    public function getDanceLocationUrlToTheirSite(): string {
        return $this->dance_location_urlToTheirSite;
    }

    public function getDanceLocationImageUrl(): string {
        return $this->dance_location_imageUrl;
    }

    // setters
    public function setDanceLocationId(int $id): self {
        $this->dance_location_id = $id;
        return $this;
    }

    public function setDanceLocationName(string $name): self {
        $this->dance_location_name = $name;
        return $this;
    }

    public function setDanceLocationStreet(string $street): self {
        $this->dance_location_street = $street;
        return $this;
    }

    public function setDanceLocationNumber(int $number): self {
        $this->dance_location_number = $number;
        return $this;
    }

    public function setDanceLocationPostcode(string $postcode): self {
        $this->dance_location_postcode = $postcode;
        return $this;
    }

    public function setDanceLocationCity(string $city): self {
        $this->dance_location_city = $city;
        return $this;
    }

    public function setDanceLocationUrlToTheirSite(string $url): self {
        $this->dance_location_urlToTheirSite = $url;
        return $this;
    }

    public function setDanceLocationImageUrl(string $url): self {
        $this->dance_location_imageUrl = $url;
        return $this;
    }
    
    //ctor
    /* public function __construct(
        int $id,
        string $name,
        string $street,
        int $number,
        string $postcode,
        string $city,
        string $urlToTheirSite,
        string $imageUrl
    ) {
        $this->dance_location_id = $id;
        $this->dance_location_name = $name;
        $this->dance_location_street = $street;
        $this->dance_location_number = $number;
        $this->dance_location_postcode = $postcode;
        $this->dance_location_city = $city;
        $this->dance_location_urlToTheirSite = $urlToTheirSite;
        $this->dance_location_imageUrl = $imageUrl;
    }*/
}
?>