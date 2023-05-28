<?php
require_once __DIR__ . '/repository.php';
require_once  __DIR__ . '/../Models/Recipe.php';

class RecipeRepository extends Repository
{
    public function getAllRecipes()
    {
        try {
            $statement = $this->connection->prepare("SELECT id, name, title, pictureURL,
       duration, type, content FROM recipes");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'Recipe');
            $recipes = $statement->fetchAll();

            return $recipes;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getByName(string $name)
    {
        try {
            $statement = $this->connection->prepare("SELECT id, name	, title, pictureURL,
       duration, type, content FROM recipes WHERE name = :name");
            //TODO make sure that the name comes from a dropdown option no input from the user
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Recipe');

            $recipe = $statement->fetch();

            return $recipe;
        } catch (PDOEXCEPTION $e) {
            echo $e;
        }
    }


}