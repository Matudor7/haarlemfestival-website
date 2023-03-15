<?php

class ArtistModel{
    private int $dance_artist_id = 0;
    private string $dance_artist_name = ""; 
    private bool $dance_artist_hasDetailPage; 
    private string $dance_artist_imageUrl;
    private string $dance_artist_detailPageUrl = "";

    #[ReturnTypeWillChange]

    //getters
    public function getId(): int{
        return $this->dance_artist_id;
    }

    public function getName(): string{
        return $this->dance_artist_name;
    }
    public function getHasDetailPage(): bool{
        return $this->dance_artist_hasDetailPage;
    }
    public function getArtistHomepageImageUrl(): string{
        return $this->dance_artist_imageUrl;
    }    

    //setters
    public function setName(string $name): self{
        $this->dance_artist_name = $name;
        return $this;
    }
    public function setHasDetailPAge(bool $hasDetailPage): self{
        $this->dance_artist_hasDetailPage = $hasDetailPage;
        return $this;
    }
    public function setArtistHomepageImageUrl(string $url):self{
        $this->dance_artist_imageUrl = $url;
        return $this;
    }

    //ctor
    /*public function __construct($id, $name, $musicType, $hasDetailPage, $url) {
    }*/
}
?>