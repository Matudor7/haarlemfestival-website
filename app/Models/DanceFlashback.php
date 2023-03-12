<?php
class DanceFlashback {
    private int $dance_flashback_id = 0;
    private string $dance_flashback_url = ""; 
    private string $dance_flashback_credit = ""; 
    private string $dance_flashback_extranote = ""; 

    // Getters
    public function getDanceFlashbackId(): int {
        return $this->dance_flashback_id;
    }

    public function getDanceFlashbackUrl(): string {
        return $this->dance_flashback_url;
    }

    public function getDanceFlashbackCredit(): string {
        return $this->dance_flashback_credit;
    }

    public function getDanceFlashbackExtranote(): string {
        return $this->dance_flashback_extranote;
    }

    // Setters
    public function setDanceFlashbackId(int $id): self {
        $this->dance_flashback_id = $id;
        return $this;
    }

    public function setDanceFlashbackUrl(string $url): self {
        $this->dance_flashback_url = $url;
        return $this;
    }

    public function setDanceFlashbackCredit(string $credit): self {
        $this->dance_flashback_credit = $credit;
        return $this;
    }

    public function setDanceFlashbackExtranote(string $extranote): self {
        $this->dance_flashback_extranote = $extranote;
        return $this;
    }

    //ctor
    /*public function __construct(int $id, string $url, string $credit, string $extranote) {
        $this->dance_flashback_id = $id;
        $this->dance_flashback_url = $url;
        $this->dance_flashback_credit = $credit;
        $this->dance_flashback_extranote = $extranote;
    }*/
}
?>