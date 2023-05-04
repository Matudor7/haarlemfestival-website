<?php

class Ticket
{

    private int $id;
    private int $quantity;
    private float $price;
    private ?int $dance_event_id;
    private ?int $yummy_event_id;
    private ?int $history_event_id;
    private ?int $access_pass_id;
    private string $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getDanceEventId(): ?int
    {
        return $this->dance_event_id;
    }

    /**
     * @param int|null $dance_event_id
     */
    public function setDanceEventId(?int $dance_event_id): void
    {
        $this->dance_event_id = $dance_event_id;
    }

    /**
     * @return int|null
     */
    public function getYummyEventId(): ?int
    {
        return $this->yummy_event_id;
    }

    /**
     * @param int|null $yummy_event_id
     */
    public function setYummyEventId(?int $yummy_event_id): void
    {
        $this->yummy_event_id = $yummy_event_id;
    }

    /**
     * @return int|null
     */
    public function getHistoryEventId(): ?int
    {
        return $this->history_event_id;
    }

    /**
     * @param int|null $history_event_id
     */
    public function setHistoryEventId(?int $history_event_id): void
    {
        $this->history_event_id = $history_event_id;
    }

    /**
     * @return int|null
     */
    public function getAccessPassId(): ?int
    {
        return $this->access_pass_id;
    }

    /**
     * @param int|null $access_pass_id
     */
    public function setAccessPassId(?int $access_pass_id): void
    {
        $this->access_pass_id = $access_pass_id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int|null
     */
    public function getVatId(): ?int
    {
        return $this->vat_id;
    }

    /**
     * @param int|null $vat_id
     */
    public function setVatId(?int $vat_id): void
    {
        $this->vat_id = $vat_id;
    }
    private int $order_id;
    private int $user_id;
    private ?int $vat_id;

}