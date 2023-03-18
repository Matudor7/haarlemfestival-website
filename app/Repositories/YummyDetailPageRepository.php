<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/YummyDetailPageModel.php';

class YummyDetailPageRepository extends Repository
{
    public function getAllContent()
    {
        try {
            $statement = $this->connection->prepare("SELECT detail_id, detailPic1_URL	, detailPic2_URL, detailPic3_URL,
       aboutUs, menu,timeSlot FROM yummyDetailPage");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'YummyDetailPageModel');
            $content = $statement->fetchAll();

            return $content;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getContentById($detail_id)
    {
        try {
            $statement = $this->connection->prepare("SELECT detail_id, detailPic1_URL	, detailPic2_URL, detailPic3_URL,
       aboutUs, menu,timeSlot FROM yummyDetailPage WHERE  detail_id = :detail_id");
            //TODO make sure that the name comes from a dropdown option no input from the user
            $statement->bindParam(':detail_id', $detail_id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'YummyDetailPageModel');

            $content = $statement->fetch();

            return $content;
        } catch (PDOEXCEPTION $e) {
            echo $e;
        }
    }

}