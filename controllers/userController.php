<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/userModel.php');

class userController
{
    // ajouter une note a une recette 
    public function rateRecipe($recipeId, $note)
    {

        if (!isset($_COOKIE["logedIn_user"])) {
            return ; 
            // header("/projetWeb/login");
        };
        $userModel = new userModel();
        $userModel->rateRecipe($_COOKIE["logedIn_user"], $recipeId, $note);
        echo "done";
    }

    public function getUserRecipeRating($recipeId)
    {
        if (!isset($_COOKIE["logedIn_user"])) {
            return null;
        }
        $userModel = new userModel();
        $response = $userModel->getUserRecipeRating($_COOKIE["logedIn_user"], $recipeId);
        if ($response) return $response[0];
        else return null;
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
        if (!isset($_COOKIE["logedIn_user"])) {
            header("location: /ProjetWeb/login");
            return;
        }
        $userModel = new userModel();
        $userModel->likeRecette($_COOKIE["logedIn_user"], $_POST["recetteID"]);
        return;
    }

    public function userIsLikeRecipe($recipeId)
    {
        $userModel = new userModel();
        return $userModel->userIsLikeRecipe($recipeId);
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

    public function createUser()
    {
        $userModel = new userModel();
        $userModel->createUser();
        return;
    }

    // user stats
    public function userStats($userId)
    {
        $userModel = new userModel();
        $response = $userModel->userStats($userId);
        return $response[0];
    }

    // favourite posts 
    public function getVafouritePosts($userId)
    {
        $userModel = new userModel();
        $response = $userModel->getVafouritePosts($userId);
        return $response;
    }

    // edded recipe by user
    public function getUserAddedRecipes($userId)
    {
        $userModel = new userModel();
        $response = $userModel->getUserAddedRecipes($userId);
        return $response;
    }

    
}
