<?php
class WalkingTourContentModel implements JsonSerializable{
    private int $Id;
    private string $section_name;
    private string $title;
    private string $text;
    private string $button_text;

    #[ReturnTypeWillChange]
    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }
    public function setId(int $id){
        $this->Id = $id;
    }
    public function setSection(string $section){
        $this->section_name = $section;
    }
    public function setTitle(string $title){
            $this->title = $title;
    }
    public function setText(string $text){
        $this->text = $text;
    }
    public function setButtonText(string $text){
        $this->button_text = $text;
    }

    public function getId(): int{
        return $this->Id;
    }
    public function getSection(): string{
        return $this->section_name;
    }
    public function getTitle(): string{
        return $this->title;
    }
    public function getText(): string{
        return $this->text;
    }
    public function getButtonText() : string{
        return $this->button_text;
    }
}