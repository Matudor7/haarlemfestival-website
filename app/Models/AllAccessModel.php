<?php
class AllAccessModel
{
private int $Id, $availability;
private string $type, $location;
private float $price;
private DateTime $starting_date, $ending_date;

public function getId(): int{
    return $this->Id;
}
public function getAvailability(){
    return $this->availability;
}
public function getType() : int{
    return $this->type;
}public function getLocation():int{
    return $this->location;
}public function getPrice():float{
    return $this->price;
}public function getStartDate():DateTime{
    return $this->starting_date;
}public function getEndDate():DateTime{
    return $this->ending_date;
}

public function setId(int $id){
    $this->Id = $id;
}
public function setAvailability(int $availability){
    $this->availability = $availability;
}
public function setType(string $type){
    $this->type = $type;
}
public function setLocation(string $location){
    $this->location = $location;
}
public function setPrice(float $price){
    $this->price = $price;
}
public function setStartDate(DateTime $startDate){
    $this->starting_date = $startDate;
}
public function setEndDate(DateTime $endDate){
    $this->ending_date = $endDate;
}
}