<?php

class DanceAlbum
{
    private int $dance_album_id = 0;
    private int $dance_album_artistId = 0;
    private string $dance_album_name = "";
    private int $dance_album_releaseYear = 0;
    private string $dance_album_imageUrl = "";

    // Getters
    public function getId(): int
    {
        return $this->dance_album_id;
    }

    public function getArtistId(): int
    {
        return $this->dance_album_artistId;
    }

    public function getName(): string
    {
        return $this->dance_album_name;
    }

    public function getReleaseYear(): int
    {
        return $this->dance_album_releaseYear;
    }

    public function getImageUrl(): string
    {
        return $this->dance_album_imageUrl;
    }

    // Setters
    public function setArtistId(int $artistId): self
    {
        $this->dance_album_artistId = $artistId;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->dance_album_name = $name;
        return $this;
    }

    public function setReleaseYear(int $releaseYear): self
    {
        $this->dance_album_releaseYear = $releaseYear;
        return $this;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->dance_album_imageUrl = $imageUrl;
        return $this;
    }
}

?>