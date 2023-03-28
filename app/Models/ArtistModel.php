<?php

class ArtistModel implements JsonSerializable{
    private int $dance_artist_id = 0;
    private string $dance_artist_name = "";
    private string $dance_artistMusicTypes = "";
    private bool $dance_artist_hasDetailPage;
    private string $dance_artist_imageUrl;
    private string $dance_artist_detailPageBanner = "";
    private ?string $dance_artist_subHeader = null;
    private string $dance_artist_longDescription = "";
    private string $dance_artist_longDescriptionPicture = "";
    private string $dance_artist_detailPageSchedulePicture = "";

    #[ReturnTypeWillChange]

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }
     //getters
    public function getId(): int
    {
        return $this->dance_artist_id;
    }
    public function getName(): string
    {
        return $this->dance_artist_name;
    }
    public function getArtistMusicTypes(): string
    {
        return $this->dance_artistMusicTypes;
    }
    public function getHasDetailPage(): bool
    {
        return $this->dance_artist_hasDetailPage;
    }
    public function getArtistHomepageImageUrl(): string
    {
        return $this->dance_artist_imageUrl;
    }
    public function getDanceArtistDetailPageBanner(): string
    {
        return $this->dance_artist_detailPageBanner;
    }
    public function getDanceArtistSubHeader(): string
    {
        return $this->dance_artist_subHeader;
    }
    public function getDanceArtistLongDescription(): string
    {
        return $this->dance_artist_longDescription;
    }
    public function getDanceArtistLongDescriptionPicture(): string
    {
        return $this->dance_artist_longDescriptionPicture;
    }
    public function getDanceArtistDetailPageSchedulePicture(): string
    {
        return $this->dance_artist_detailPageSchedulePicture;
    }
    //setters
    public function setName(string $name): self
    {
        $this->dance_artist_name = $name;
        return $this;
    }
    public function setArtistMusicTypes(string $types): self
    {
        $this->dance_artistMusicTypes = $types;
        return $this;
    }
    public function setHasDetailPAge(bool $hasDetailPage): self
    {
        $this->dance_artist_hasDetailPage = $hasDetailPage;
        return $this;
    }
    public function setArtistHomepageImageUrl(string $url): self
    {
        $this->dance_artist_imageUrl = $url;
        return $this;
    }
    public function setDanceArtistDetailPageBanner(string $banner): self
    {
        $this->dance_artist_detailPageBanner = $banner;
        return $this;
    }
    public function setDanceArtistSubHeader(string $subHeader): self
    {
        $this->dance_artist_subHeader = $subHeader;
        return $this;
    }
    public function setDanceArtistLongDescription(string $longDescription): self
    {
        $this->dance_artist_longDescription = $longDescription;
        return $this;
    }
    public function setDanceArtistLongDescriptionPicture(string $picture): self
    {
        $this->dance_artist_longDescriptionPicture = $picture;
        return $this;
    }
    public function setDanceArtistDetailPageSchedulePicture(string $picture): self 
    {
        $this->dance_artist_detailPageSchedulePicture = $picture;
        return $this;
    }
}
?>