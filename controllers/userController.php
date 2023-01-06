<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/userModel.php');

class userController
{
    // ajouter une note a une recette 
    public function rateRecipe($userId, $recipeId, $note)
    {
        $userModel = new userModel();
        $userModel->rateRecipe($userId, $recipeId, $note);
        echo "done" ; 
    }

    public function getUserRecipeRating($userId, $recipeId)
    {
        $userModel = new userModel();
        $response = $userModel->getUserRecipeRating($userId, $recipeId);
        return $response[0];
    }

    // ajouter un commentaire 
    public function commentPost()
    {
        $userModel = new userModel();
        $userModel->commentPost($_POST["userID"], $_POST["recetteID"], $_POST["comment"]);
        return;
    }

    // like recette 
    public function likeRecette()
    {
        $userModel = new userModel();
        $userModel->likeRecette($_POST["userID"], $_POST["recetteID"]);
        return;
    }

    // save news 
    public function saveNews()
    {
        $userModel = new userModel();
        $userModel->saveNews($_POST["userID"], $_POST["recetteID"]);
        return;
    }

    public function getUserById($userId)
    {
        $userModel = new userModel();
        $response = $userModel->getUserById($userId);
        return $response[0];
    }
}
