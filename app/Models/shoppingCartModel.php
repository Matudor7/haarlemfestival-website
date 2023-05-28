<?php
//Tudor Nosca (678549)
class ShoppingCart implements JsonSerializable{
    private int $user_id = 0;
    public $product_id = []; //int array
    public $amount = [];

    /**
     * @return array
     */
    public function getProductId(): array
    {
        return $this->product_id;
    }

    /**
     * @param array $product_id
     */
    public function setProductId(array $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return array
     */
    public function getAdditionalInfo(): array
    {
        return $this->additional_info;
    }

    /**
     * @param array $additional_info
     */
    public function setAdditionalInfo(array $additional_info): void
    {
        $this->additional_info = $additional_info;
    } //int array
    public int $event_type;
    private $additional_info = []; //string array

    /**
     * @return int
     */
    public function getEventType(): int
    {
        return $this->event_type;
    }

    /**
     * @param int $event_type
     */
    public function setEventType(int $event_type): void
    {
        $this->event_type = $event_type;
    }

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

    public function getInfo(){
        return $this->additional_info;
    }

    public function addInfo($additional_info){
        if(is_null($additional_info)){
            $additional_info = "";
        }
        array_push($this->additional_info, $additional_info);
    }
}
?>