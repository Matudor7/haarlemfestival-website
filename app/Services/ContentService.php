<?php
require __DIR__ . '/../Repositories/ContentRepository.php';

class ContentService
{
    private $contentRepository; 

    //ctor
    public function __construct() {
        $this->contentRepository = new ContentRepository(); 
    }

    public function getAllContent(){
        $allContent = $this->contentRepository->getallContentFromDatabase();
        return $allContent;
    }
    public function update($id, $content)
    {
        $this->contentRepository->updateContentInTheDatabase($id, $content);
    }
}