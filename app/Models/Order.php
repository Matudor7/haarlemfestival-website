<?php

class Order
{
    private int $order_id = 0;
    private int $payment_id;
    private string $invoice_date;
    private string $invoice_number;
    private string $list_Product_id = "";

    private string $payment_status = "";

    public function getListProductId():string {
        return $this->list_Product_id;
    }
   /* public function getListProductId(): array{
        return explode(",", $this->List_Product_id);
    }*/
    public function setListProductId($list_Product_id)
    {
        $this->list_Product_id = $list_Product_id;
    }


    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    public function getPaymentId(): int
    {
        return $this->payment_id;
    }

    public function setPaymentId(int $payment_id): void
    {
        $this->payment_id = $payment_id;
    }

    public function getInvoiceDate(): string
    {
        return $this->invoice_date;
    }


    public function setInvoiceDate(): void
    {
        $this->invoice_date = date("Y-m-d H:i:s");
    }


    public function getInvoiceNumber(): string
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(): void
    {
        $this->invoice_number = $this->generateInvoiceNumber();
    }

    private function generateInvoiceNumber() {
        // Get the current year in two digits
        $year = date("y");

        // Get the current month in two digits
        $month = date("m");

        // Generate a random 3-digit number
        $random = rand(100, 999);

        // Combine the year, month, and random number to create the invoice number
        $invoice_number = "INV-" . $year . "-" . $month . "-" . $random;

        return $invoice_number;
    }

    public function getPaymentStatus(){
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status){
        $this->payment_status = $payment_status;
    }
}