<?php
class DanceSession  implements JsonSerializable{
    private int $dance_sessionType_id = 0;
    private string $dance_sessionType_name = ""; 

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    //getters
    public function getDanceSessionId(): int{
        return $this->dance_sessionType_id;
    }

    public function getDanceSessionName(): string{
        return $this->dance_sessionType_name;
    }

    //setters
    public function setDanceSessionName(string $name): self{
        $this->dance_sessionType_name = $name;
        return $this;
    }
}
?>