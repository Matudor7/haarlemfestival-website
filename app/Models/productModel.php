<?php
//Tudor Nosca (678549)
class Product implements JsonSerializable{
    private int $id = 0;
    private string $name = "";
    private int $event_type = 0;
    private string $starting_time = "";
    private string $location = "";
    private int $price= 0;
    private string $additional_info = "";

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }

    public function getEventType(): int{
        return $this->event_type;
    }

    public function setEventType(int $event_type): self{
        $this->event_type = $event_type;
        return $this;
    }

    public function getStartTime(): string{
        return $this->starting_time;
    }
    public function getProductDate(){
        $date = DateTime::createFromFormat(('Y-m-d H:i:s'),$this->starting_time);
        return $date->format('Y-m-d');
    }
    public function getProductTime(){
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $this->starting_time);
        return $time->format('H:i');
    }
    public function setStartTime(string $starting_time): self{
        $this->starting_time = $starting_time;
        return $this;
    }

    public function getLocation(): string{
        return $this->location;
    }

    public function setLocation(string $location): self{
        $this->location = $location;
        return $this;
    }

    public function getPrice(): int{
        return $this->price;
    }

    public function setPrice(int $price): self{
        $this->price = $price;
        return $this;
    }

    public function getInfo(): string{
        return $this->additional_info;
    }

    public function setInfo(string $additional_info): self{
        $this->additional_info = $additional_info;
        return $this;
    }
}
?>