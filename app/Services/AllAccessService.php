<?php
require __DIR__ . '/../Repositories/AllAccessRepository.php';
class AllAccessService
{
    private $allAccessRepo;
    public function __construct() {
        $this->allAccessRepo = new AllAccessRepository();
    }

public function getAllAccessContent(string $elementId) : string{
        return $this->allAccessRepo->getAllAccessContent($elementId);
}
}