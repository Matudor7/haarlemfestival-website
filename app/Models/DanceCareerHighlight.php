<?php

class CareerHighlight
{
    private int $dance_careerHighlights_id = 0;
    private int $dance_careerHighlights_artistId = 0;
    private string $dance_careerHighlights_description = "";
    private string $dance_careerHighlights_imageUrl = "";
    private bool $dance_careerHighlights_alignment;

    // getters
    public function getId(): int
    {
        return $this->dance_careerHighlights_id;
    }

    public function getArtistId(): int
    {
        return $this->dance_careerHighlights_artistId;
    }

    public function getDescription(): string
    {
        return $this->dance_careerHighlights_description;
    }

    public function getImageUrl(): string
    {
        return $this->dance_careerHighlights_imageUrl;
    }

    public function getAlignment(): bool
    {
        return $this->dance_careerHighlights_alignment;
    }

    // setters
    public function setId(int $id): self
    {
        $this->dance_careerHighlights_id = $id;
        return $this;
    }

    public function setArtistId(int $artistId): self
    {
        $this->dance_careerHighlights_artistId = $artistId;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->dance_careerHighlights_description = $description;
        return $this;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->dance_careerHighlights_imageUrl = $imageUrl;
        return $this;
    }

    public function setAlignment(bool $alignment): self
    {
        $this->dance_careerHighlights_alignment = $alignment;
        return $this;
    }
}
?>