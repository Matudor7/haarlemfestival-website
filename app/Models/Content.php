<?php
class Content implements \JsonSerializable
{
    private int $content_id;
    private ?string $content_text;
    private ?string $content_imageUrl;

    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getContentId(): int {
        return $this->content_id;
    }
    
    public function getContentText(): string {
        return $this->content_text;
    }
    
    public function getContentImageUrl(): string {
        return $this->content_imageUrl;
    }
    
    public function setContentId(int $content_id): self {
        $this->content_id = $content_id;
        return $this;
    }
    
    public function setContentText(string $content_text): self {
        $this->content_text = $content_text;
        return $this;
    }
    
    public function setContentImageUrl(string $content_imageUrl): self {
        $this->content_imageUrl = $content_imageUrl;
        return $this;
    }
}

?>