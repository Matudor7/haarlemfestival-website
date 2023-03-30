<?php
class MusicType  implements JsonSerializable{
    private int $dance_musicType_id = 0;
    private string $dance_musicType_name = ""; 

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    //getters
    public function getId(): int{
        return $this->dance_musicType_id;
    }

    public function getMusicTypeName(): string{
        return $this->dance_musicType_name;
    }

    //setters
    public function setMusicTypeName(string $name): self{
        $this->dance_musicType_name = $name;
        return $this;
    }
}
?>