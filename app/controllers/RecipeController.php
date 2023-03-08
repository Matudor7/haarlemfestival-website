<?php

require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/RecipeService.php';

class RecipeController extends Controller
{
    public function index()
    {
        $eventService = new EventService();
        $events = $eventService->getAll();


        $recipeService = new RecipeService();
        $recipes = $recipeService->getAllRecipess();

        require __DIR__ . '/../views/yummy/index.php';

    }


}
