<?php
//Tudor Nosca (678549)
class Product implements JsonSerializable{
    public int $id = 0;
    public string $name = "";
    public int $event_type = 0;
    public string $starting_time = "";
    public string $location = "";
    public float $price= 0;
    public int $available_seats = 0;
    public float $vat = 0.21;

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

    public function getAvailableSeats(): int{
        return $this->available_seats;
    }

    public function setAvailableSeats(int $available_seats): self{
        $this->available_seats = $available_seats;
        return $this;
    }
    //Ale
    public function calculateTotalPriceForProduct($amount,$price): float{
        return $this->price * $amount;
    }
    public function calculateVat($subtotal){
        return $subtotal * $this->vat;
    }
    public function calculateTotal($subtotal, $tax): float{
        return $this->$subtotal + $tax;
    }
}
?>