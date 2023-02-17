<?php

class HomepageContent{
    private int $id;
    private string $name;
    private string $url;
    private string $text;

    #[ReturnTypeWillChange]

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }
}
?>