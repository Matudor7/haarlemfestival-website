<?php
//Tudor Nosca (678549)
class ShoppingCart implements JsonSerializable{
    private int $user_id = 0;
    private $product_id = []; //int array
    private $amount = []; //int array

    #[ReturnTypeWillChange]
    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getUserId(): int{
        return $this->user_id;
    }

    public function setUserId(int $user_id): self{
        $this->user_id = $user_id;
        return $this;
    }

    public function getProducts(){
        return $this->product_id;
    }

    public function addProduct(int $product_id): void{
        array_push($this->product_id, $product_id);
    }

    public function getAmount(){
        return $this->amount;
    }

    public function addAmount(int $amount): void{
        array_push($this->amount, $amount);
    }
}
?>