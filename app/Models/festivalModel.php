<?php

class Festival implements JsonSerializable{
    private int $id = 0;

    private string $festival_startingDate = "";

    private string $festival_endingDate = "";

    private int $event_id = 0;

    private string $event_name = "";
    

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getStartingDate(): string{
        return $this->festival_startingDate;
    }

    public function setStartingDate(string $startDate): self{
        $this -> festival_startingDate = $startDate;
        return $this;
    }

    public function getEndingDate(): string{
        return $this -> festival_endingDate;
    }

    public function setEndingDate(string $endDate): self{
        $this -> festival_endingDate = $endDate;
        return $this;
    }

    public function getEventId(): int{
        return $this -> event_id;
    }

    public function setEventId(int $id): self{
        $this -> event_id = $id;
        return $this;
    }

    public function getEventName(): string{
        return $this->event_name;
    }

    public function setEventName(string $name):self{
        $this ->event_name = $name;
        return $this;
    }
}
?>