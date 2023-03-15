<?php

require __DIR__ . '/../Repositories/RecipeRepository.php';

class RecipeService
{
    public function getAllRecipes()
    {
        $recipeRepo = new RecipeRepository();
        $recipeRepo = $recipeRepo->getAllRecipes();

        return $recipeRepo;
    }

    public function getRecipeByName(string $name)
    {
        $recipeRepo = new YummyRepository();
        $recipeRepo = $recipeRepo->getByName($name);

        return $recipeRepo;
    }
}