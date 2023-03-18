<?php

class YummyDetailPageModel
{
    private int $detail_id;
    private string $detailPic1_URL;
    private string $detailPic2_URL;
    private string $detailPic3_URL;
    private string $aboutUs;
    private string $menu;
    private string $timeSlot;


    public function getDetailId(): int
    {
        return $this->detail_id;
    }

    public function setDetailId(int $detail_id): void
    {
        $this->detail_id = $detail_id;
    }

    public function getDetailPic1URL(): string
    {
        return $this->detailPic1_URL;
    }


    public function setDetailPic1URL(string $detailPic1_URL): void
    {
        $this->detailPic1_URL = $detailPic1_URL;
    }


    public function getDetailPic2URL(): string
    {
        return $this->detailPic2_URL;
    }

    public function setDetailPic2URL(string $detailPic2_URL): void
    {
        $this->detailPic2_URL = $detailPic2_URL;
    }


    public function getDetailPic3URL(): string
    {
        return $this->detailPic3_URL;
    }

    public function setDetailPic3URL(string $detailPic3_URL): void
    {
        $this->detailPic3_URL = $detailPic3_URL;
    }

    public function getAboutUs(): string
    {
        return $this->aboutUs;
    }


    public function setAboutUs(string $aboutUs): void
    {
        $this->aboutUs = $aboutUs;
    }


    public function getMenu(): string
    {
        return $this->menu;
    }


    public function setMenu(string $menu): void
    {
        $this->menu = $menu;
    }


    public function getTimeSlotContent(): string
    {
        return $this->timeSlot;
    }


    public function setTimeSlot(string $timeSlot): void
    {
        $this->timeSlot = $timeSlot;
    }

}