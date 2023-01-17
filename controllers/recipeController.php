<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/recipeModel.php');
class recipeController
{
    public function getRecipes($params)
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getrecipes($params);
        return $response;
    }
    public function addRecipe()
    {
        try {
            $recipeModel = new recipeModel();
            $response = $recipeModel->addRecipe($_POST);
            return $response;
        } catch (Exception $e) {
            echo var_dump($e);
        }
        return;
    }
    public function validateRecipe($recipeID)
    {
        $recipeModel = new recipeModel();
        $recipeModel->validateRecipe($recipeID);
    }
    public function rejectRecipe($recipeID)
    {
        $recipeModel = new recipeModel();
        $recipeModel->rejectRecipe($recipeID);
    }

    public function getRecipe($id)
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getRecipe($id);
        return $response[0];
    }
    public function getrecipesByCateg($idCateg)
    {

        $recipeModel = new recipeModel();
        $response = $recipeModel->getrecipesByCateg($idCateg);

        return $response;
    }

    public function getHealthyRecipes($avg)
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getHealthyRecipes($avg);

        return $response;
    }

    public function getNbRecipes()
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getNbRecipes();
        return $response[0];
    }

    public function addIngredientToRecipe()
    {
        $recipeModel = new recipeModel();
        $recipeModel->addIngredientToRecipe();
        return;
    }
    public function addStepToRecipe()
    {
        $recipeModel = new recipeModel();
        $recipeModel->addStepToRecipe();
        return;
    }

    public function getEventsRecipes($params)
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getEventsRecipes($params);
        return $response;
    }


    public function getRecipeByPost($postId)
    {
        $recipeModel = new recipeModel();
        $response = $recipeModel->getRecipeByPost($postId);
        return $response[0];
    }
}
