<?php

class DanceSong
{
    private int $dance_song_id  = 0;
    private int $dance_song_artistId = 0;
    private string $dance_song_name = "";
    private string $dance_song_imageUrl = "";
    private string $dance_song_mp3Url = "";

    // Getters
    public function getSongId(): int
    {
        return $this->dance_song_id;
    }

    public function getSongArtistId(): int
    {
        return $this->dance_song_artistId;
    }

    public function getSongName(): string
    {
        return $this->dance_song_name;
    }

    public function getSongImageUrl(): string
    {
        return $this->dance_song_imageUrl;
    }
    public function getSongMp3Url(): string
    {
        return $this->dance_song_mp3Url;
    }

    // Setters
    public function setSongArtistId(int $artistId): self
    {
        $this->dance_song_artistId = $artistId;
        return $this;
    }

    public function setSongName(string $name): self
    {
        $this->dance_song_name = $name;
        return $this;
    }

    public function setSongImageUrl(string $imageUrl): self
    {
        $this->dance_song_imageUrl = $imageUrl;
        return $this;
    }

    public function setSongMp3eUrl(string $mp3Url): self
    {
        $this->dance_song_mp3Url = $mp3Url;
        return $this;
    }

}

?>