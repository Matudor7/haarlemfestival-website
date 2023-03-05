<?php

class ArtistModel{
    private int $artist_id = 0;
    private string $artist_name = "";
    private MusicType $artist_MusicType;   
    private bool $artist_HasDetailPage; 
    private string $artist_UrlInHomepage;

    #[ReturnTypeWillChange]

    //getters
    public function getId(): int{
        return $this->artist_id;
    }

    public function getName(): string{
        return $this->artist_name;
    }
    public function getMusicType(): MusicType{
        return $this->artist_MusicType;
    }
    public function getHasDetailPage(): bool{
        return $this->artist_HasDetailPage;
    }
    public function getUrlRedirect(): string{
        return $this->artist_UrlInHomepage;
    }

    //setters
    public function setName(string $name): self{
        $this->artist_name = $name;
        return $this;
    }
    public function setMusicType(MusicType $musicType): self{
        $this->artist_MusicType = $musicType;
        return $this;
    }
    public function setHasDetailPAge(bool $hasDetailPage): self{
        $this->artist_HasDetailPage = $hasDetailPage;
        return $this;
    }
    public function setUrlRedirect(string $url):self{
        $this->artist_UrlInHomepage = $url;
        return $this;
    }

    //ctor
    /*public function __construct($id, $name, $musicType, $hasDetailPage, $url) {
        $this->artist_id = $id;
        $this->artist_name = $name;
        $this->artist_musicType = $musicType;
        $this->artist_hasDetailPage = $hasDetailPage;
        $this->artist_urlInHomepage = $url;
    }*/
}
?>