<?php

class Recipe
{

    private int $id = 0;
    private string $name;
    private string $title;
    private string $pictureURL;
    private $duration;
    private $type;
    private $content;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getPictureURL(): string
    {
        return $this->pictureURL;
    }


    public function setPictureURL(string $pictureURL): void
    {
        $this->pictureURL = $pictureURL;
    }


    public function getDuration()
    {
        return $this->duration;
    }


    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type): void
    {
        $this->type = $type;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function setContent($content): void
    {
        $this->content = $content;
    }


}