<?php
//Tudor Nosca (678549)
class Vat{
    private int $id = 0;
    private int $amount = 0;

    public function getId(): int{
        return $this->id;
    }

    public function getAmount(): int{
        return $this->amount;
    }
}