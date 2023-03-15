<?php

class ArtistMusicType{
    private int $dance_artistMusicType_artistId = 0;
    private int $dance_artistMusicType_musicTypeId = 0;

    #[ReturnTypeWillChange]

    //getters
    public function getArtistId(): int{
        return $this->dance_artistMusicType_artistId;
    }
    public function getMusicTypeId(): int{
        return $this->dance_artistMusicType_musicTypeId;
    }


    //setters
    //no setters because artist setter is in artistModel and musicType setter is in MusicType.
    //use them. dont code setters here.

    public function setArtistId(int $id): self{
        $this->dance_artistMusicType_artistId = $id;
        return $this;
    }

    public function setMusicTypeId(int $id): self{
        $this->dance_artistMusicType_musicTypeId = $id;
        return $this;
    }

    //ctor
    /*public function __construct($artistId, $musicTypeId) {
        $this->dance_artistMusicType_artistId = $artistId;
        $this->dance_artistMusicType_musicTypeId = $musicTypeId;
    }*/
}
?>