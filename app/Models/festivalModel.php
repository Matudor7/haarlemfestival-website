<?php

class Festival{
    private int $festival_id = 0;

    private string $festival_startingDate = "";

    private string $festival_endingDate = "";

    private int $event_id = 0;
    

    #[ReturnTypeWillChange]

    public function getId(): int{
        return $this->festival_id;
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
}
?>