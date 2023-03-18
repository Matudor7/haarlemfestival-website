<?php
require __DIR__ . '/../Repositories/YummyDetailPageRepository.php';

class YummyDetailPageService
{
    public function getAllContent()
    {
        $yummyDetailRepo = new YummyDetailPageRepository();
        $yummyContent = $yummyDetailRepo->getAllContent();

        return $yummyContent;
    }

    public function getContentById($detail_id)
    {
        $yummyDetailRepo = new YummyDetailPageRepository();
        $yummyContent = $yummyDetailRepo->getContentById($detail_id);

        return $yummyContent;
    }

}