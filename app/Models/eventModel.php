<?php

class Event{
    private int $event_id = 0;
    private string $event_name = "";
    private string $event_urlRedirect = "";
    #private string $text;

    private string $event_imageUrl = "";

    #[ReturnTypeWillChange]

    public function getId(): int{
        return $this->event_id;
    }

    public function getName(): string{
        return $this->event_name;
    }

    public function setName(string $name): self{
        $this->event_name = $name;
        return $this;
    }

    public function getUrlRedirect(): string{
        return $this->event_urlRedirect;
    }

    public function setUrlRedirect(string $url):self{
        $this->event_urlRedirect = $url;
        return $this;
    }

    public function getImageUrl() : string{
        return $this->event_imageUrl;
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