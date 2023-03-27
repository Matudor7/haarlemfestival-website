<?php
class ShoppingCart implements JsonSerializable{
    private int $user_id = 0;
    private $product_ids = []; //int array
    private $amounts = []; //int array

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
        return $this->product_ids;
    }

    public function addProduct(int $product_id): void{
        array_push($this->product_ids, $product_id);
    }

    public function getAmount(){
        return $this->amounts;
    }

    public function addAmount(int $amount): void{
        array_push($this->amounts, $amount);
    }
}
?>