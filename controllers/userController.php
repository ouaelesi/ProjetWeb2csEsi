<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/userModel.php');

class userController
{
    // ajouter une note a une recette 
    public function rateRecipe()
    {
        $userModel = new userModel();
        $userModel->rateRecipe($_POST["userID"], $_POST["recetteID"], $_POST["note"]);
        return;
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

    public function getUserById($userId){
        $userModel = new userModel();
        $response = $userModel->getUserById($userId);
        return $response[0];
    }
}
