<?php

class Order
{
    private int $order_id;
    private int $payment_id;
    private string $invoice_date;
    private int $invoice_number;
    private string $List_Restaurant_Product_id;
    private string $List_dance_Product_id;
    private string $List_Tour_Product_id;

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return int
     */
    public function getPaymentId(): int
    {
        return $this->payment_id;
    }

    /**
     * @param int $payment_id
     */
    public function setPaymentId(int $payment_id): void
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return string
     */
    public function getInvoiceDate(): string
    {
        return $this->invoice_date;
    }

    /**
     * @param string $invoice_date
     */
    public function setInvoiceDate(string $invoice_date): void
    {
        $this->invoice_date = $invoice_date;
    }

    /**
     * @return int
     */
    public function getInvoiceNumber(): int
    {
        return $this->invoice_number;
    }

    /**
     * @param int $invoice_number
     */
    public function setInvoiceNumber(int $invoice_number): void
    {
        $this->invoice_number = $invoice_number;
    }

    /**
     * @return string
     */
    public function getListRestaurantProductId(): string
    {
        return $this->List_Restaurant_Product_id;
    }

    /**
     * @param string $List_Restaurant_Product_id
     */
    public function setListRestaurantProductId(string $List_Restaurant_Product_id): void
    {
        $this->List_Restaurant_Product_id = $List_Restaurant_Product_id;
    }

    /**
     * @return string
     */
    public function getListDanceProductId(): string
    {
        return $this->List_dance_Product_id;
    }

    /**
     * @param string $List_dance_Product_id
     */
    public function setListDanceProductId(string $List_dance_Product_id): void
    {
        $this->List_dance_Product_id = $List_dance_Product_id;
    }

    /**
     * @return string
     */
    public function getListTourProductId(): string
    {
        return $this->List_Tour_Product_id;
    }

    /**
     * @param string $List_Tour_Product_id
     */
    public function setListTourProductId(string $List_Tour_Product_id): void
    {
        $this->List_Tour_Product_id = $List_Tour_Product_id;
    }
    public function getListTourProductIdAsArray(): array{
        return explode(",", $this->List_Tour_Product_id);
    }
    public function getListDanceProductIdAsArray(): array{
        return explode(",", $this->List_dance_Product_id);
    }
    public function getListRestaurantProductIdAsArray(): array{
        return explode(",", $this->List_Restaurant_Product_id);
    }

}