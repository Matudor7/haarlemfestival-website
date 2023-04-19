<?php
class WalkingTourContentModel{
    private int $Id;
    private string $element_name;
    private string $title;
    private string $text;
    private string $button_text;

    public function setId(int $id){
        $this->Id = $id;
    }
    public function setElementName(string $name){
        $this->element_name = $name;
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
    public function getElementName(): string{
        return $this->element_name;
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