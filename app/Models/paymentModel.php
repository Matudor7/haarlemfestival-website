<?php
//Tudor Nosca (678549)
class PaymentDetailsModel implements JsonSerializable{
    private int $id = 0;
    private int $user_id = 0;
    private string $first_name = "";
    private string $last_name = "";
    private string $email = "";
    private string $address = "";
    private string $zip = "";
    private string $payment_method = "";
    private string $card_name = "";
    private string $card_number = "";
    private string $card_expiration = "";
    private string $CVV = "";
    private int $total = 0;
    private string $payment_id = "";

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getUserId(): int{
        return $this->user_id;
    }

    public function setUserid(int $user_id){
        $this->user_id = $user_id;
    }

    public function getFirstName(): string{
        return $this->first_name;
    }

    public function setFirstName(string $first_name){
        $this->first_name = $first_name;
    }

    public function getLastName(): string{
        return $this->last_name;
    }

    public function setLastName(string $last_name){
        $this->last_name = $last_name;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getAddress(): string{
        return $this->address;
    }

    public function setAddress(string $address){
        $this->address = $address;
    }

    public function getZip(): string{
        return $this->zip;
    }

    public function setZip(string $zip){
        $this->zip = $zip;
    }

    public function getPaymentMethod(): string{
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method){
        $this->payment_method = $payment_method;
    }

    public function getCardName(): string{
        return $this->card_name;
    }

    public function setCardName(string $card_name){
        $this->card_name = $card_name;
    }

    public function getCardNumber(): string{
        return $this->card_number;
    }

    public function setCardNumber(string $card_number){
        $this->card_number = $card_number;
    }

    public function getCardExpiration(): string{
        return $this->card_expiration;
    }

    public function setCardExpiration(string $card_expiration){
        $this->card_expiration = $card_expiration;
    }

    public function getCvv(): string{
        return $this->CVV;
    }

    public function setCvv(string $CVV){
        $this->CVV = $CVV;
    }

    public function getTotal(): int{
        return $this->total;
    }

    public function setTotal(int $total){
        $this->total = $total;
    }

    public function getPaymentId(): string{
        return $this->payment_id;
    }

    public function setPaymentId(string $payment_id){
        $this->payment_id = $payment_id;
    }
}
?>