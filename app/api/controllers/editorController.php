<?php

require __DIR__ . '/../../Services/ContentService.php';
class EditorController
{
    private $editorService;

    function __construct()
    {
        $this->editorService = new ContentService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $content = $this->editorService->getAllContent();
            echo json_encode($content);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $contentJsonString = file_get_contents('php://input');
            $contentData = json_decode($contentJsonString, true);

            $id = htmlspecialchars($contentData['content_id']);
            $content = htmlspecialchars($contentData['content_text']);
            $this->editorService->update($id, $content);
        }
    }


}


?>