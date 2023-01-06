<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/recipeModel.php');
class recipeController{
    public function getRecipes($params){
        $recipeModel = new recipeModel() ; 
        $response = $recipeModel->getrecipes($params) ; 
        return $response ; 
    }
    // public function addRecipe(){
    //     $recipeModel = new recipeModel() ;
    //     $response = $recipeModel->addRecipe($_POST) ; 
    //     return $response ; 
    // }
    public function validateRecipe(){
        $recipeID = $_GET["recipe_id"] ; 
        $recipeModel = new recipeModel() ; 
        $recipeModel->validateRecipe($recipeID);
    }
    public function getRecipe($id){
        $recipeModel = new recipeModel() ; 
        $response = $recipeModel->getRecipe($id) ; 
        return $response[0]; 
    }
    public function getrecipesByCateg($idCateg){

      $recipeModel = new recipeModel() ; 
      $response = $recipeModel->getrecipesByCateg($idCateg) ; 

      return $response ; 
    }
}