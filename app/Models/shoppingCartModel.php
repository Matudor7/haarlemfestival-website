<?php
class ShoppingCart{
    private int $user_id = 0;
    private $product_ids = []; //int array
    private int $amount = 0;

    #[ReturnTypeWillChange]

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

    public function getAmount(): int{
        return $this->amount;
    }

    public function setAmount(int $amount): self{
        $this->amount = $amount;
        return $this;
    }
}
?>