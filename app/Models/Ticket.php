<?php

class Ticket
{

    public int $id;
    public int $quantity;
    public float $price;
    public ?int $dance_event_id = 0;
    public ?int $yummy_event_id = 0;
    public ?int $history_event_id = 0;
    public ?int $access_pass_id = 0;
    public string $status = "";
    public int $user_id;
    public int $order_id;
    public ?int $vat_id;

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->event_name;
    }

    /**
     * @param string $event_name
     */
    public function setEventName(string $event_name): void
    {
        $this->event_name = $event_name;
    }
    public string $event_name = "";
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
    public function setDanceEventId($dance_event_id): void
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
    public function setYummyEventId($yummy_event_id): void
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
    public function setHistoryEventId($history_event_id): void
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
    public function setAccessPassId($access_pass_id): void
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


}