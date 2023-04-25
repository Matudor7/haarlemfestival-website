<?php
require_once __DIR__ . "/repository.php";
require_once __DIR__ . "/../Models/Content.php";


class ContentRepository extends Repository
{
    public function getallContentFromDatabase() 
    {
        $sql = "SELECT `content_id`, `content_text`, `content_imageUrl` FROM `content`";
    
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Content');
            $contents = $statement->fetchAll();

            return $contents;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateContentInTheDatabase($id, $content){
        $sql = "UPDATE content
            SET content_text = :content_text
            WHERE content_id = :id";
        try{            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':content_text', $content);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
?>