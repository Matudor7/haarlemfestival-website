<?php

class Event{
    private int $id;
    private string $name;
    private string $urlRedirect;
    #private string $text;

    private string $imageUrl;

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

    public function getUrlRedirect(): string{
        return $this->urlRedirect;
    }

    public function setUrlRedirect(string $url):self{
        $this->urlRedirect = $url;
        return $this;
    }

    /*
    public function getText():string{
        return $this->text;
    }

    public function setText(string $text): self{
        $this->text = $text;
        return $this;
    }
    */
}
?>