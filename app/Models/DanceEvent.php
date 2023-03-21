<?php
class DanceEvent {
    //TODO: modift these variables as Location etc.
    private int $dance_event_id = 0;
    private DateTime $dance_event_datetime;
    private string $dance_location_name = "";
    private string $performing_artists = "";
    private string $dance_sessionType_name = "";
    private int $dance_event_duration = 0;
    private int $dance_event_availableTickets = 0;
    private float $dance_event_price = 0.0;
    private string $dance_event_extraNote = "";
    
    // Getters
    public function getDanceEventId(): int {
        return $this->dance_event_id;
    }
    
    public function getDanceEventDateTime(): DateTime {
        return $this->dance_event_datetime;
    }
    
    public function getDanceLocationName(): string {
        return $this->dance_location_name;
    }
    
    public function getPerformingArtists(): string {
        return $this->performing_artists;
    }
    
    public function getDanceSessionTypeName(): string {
        return $this->dance_sessionType_name;
    }
    
    public function getDanceEventDuration(): int {
        return $this->dance_event_duration;
    }
    
    public function getDanceEventAvailableTickets(): int {
        return $this->dance_event_availableTickets;
    }
    
    public function getDanceEventPrice(): float {
        return $this->dance_event_price;
    }
    
    public function getDanceEventExtraNote(): string {
        return $this->dance_event_extraNote;
    }
    
    // Setters
    public function setDanceEventId(int $dance_event_id): self {
        $this->dance_event_id = $dance_event_id;
        return $this;
    }
    
    public function setDanceEventDateTime(DateTime $dance_event_datetime): self {
        $this->dance_event_datetime = $dance_event_datetime;
        return $this;
    }
    
    public function setDanceLocationName(string $dance_location_name): self {
        $this->dance_location_name = $dance_location_name;
        return $this;
    }
    
    public function setPerformingArtists(string $performing_artists): self {
        $this->performing_artists = $performing_artists;
        return $this;
    }
    
    public function setDanceSessionTypeName(string $dance_sessionType_name): self {
        $this->dance_sessionType_name = $dance_sessionType_name;
        return $this;
    }
    
    public function setDanceEventDuration(int $dance_event_duration): self {
        $this->dance_event_duration = $dance_event_duration;
        return $this;
    }
    
    public function setDanceEventAvailableTickets(int $dance_event_availableTickets): self {
        $this->dance_event_availableTickets = $dance_event_availableTickets;
        return $this;
    }
    
    public function setDanceEventPrice(float $dance_event_price): self {
        $this->dance_event_price = $dance_event_price;
        return $this;
    }    
    public function setDanceEventExtraNote(string $dance_event_extraNote): self {
        $this->dance_event_extraNote = $dance_event_extraNote;
        return $this;
    }
   //ctor
}
?>