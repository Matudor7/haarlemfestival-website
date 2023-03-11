<?php

class Event implements JsonSerializable{
    private int $event_id = 0;
    private string $event_name = "";
    private string $event_urlRedirect = "";

    private string $event_imageUrl = "";

    private string $event_description = "";

    private string $event_startTime = "";

    private string $event_endTime = "";
    

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId(): int{
        return $this->event_id;
    }

    public function getName(): string{
        return $this->event_name;
    }

    public function setName(string $name): self{
        $this->event_name = $name;
        return $this;
    }

    public function getUrlRedirect(): string{
        return $this->event_urlRedirect;
    }

    public function setUrlRedirect(string $url):self{
        $this->event_urlRedirect = $url;
        return $this;
    }

    public function getImageUrl() : string{
        return $this->event_imageUrl;
    }


    public function getDescription():string{
        return $this->event_description;
    }

    public function setDescription(string $desc):self{
        $this->event_description = $desc;
        return $this;
    }

    public function getStartTime():string{
        return $this ->event_startTime;
    }

    public function setStartTime(string $startTime):self{
        $this->event_startTime = $startTime;
        return $this;
    }

    public function getEndTime(): string{
        return $this->event_endTime;
    }

    public function setEndTime(string $endTime):self{
        $this->event_endTime = $endTime;
        return $this;
    }

}
?>