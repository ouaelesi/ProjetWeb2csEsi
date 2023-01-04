<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/ingredientModel.php');

class ingredientController{
    public function getIngredients(){
        $ingredientModel = new ingredientModel() ; 
        $response = $ingredientModel->getIngredients() ; 
        $res = array() ; 
        foreach($response as $event){
            array_push($res,$event) ; 
        }
        return $res ; 
    }

    public function addIngredient(){
        $ingredientModel = new ingredientModel() ; 
        $ingredientModel->addIngredient($_POST) ; 
    }

    public function getRecipeIngredients($recipeID){
        $ingredientModel = new ingredientModel() ; 
        $response = $ingredientModel->getRecipeIngredients($recipeID) ; 
        // echo var_dump($response) ; 
        return $response ; 
    }

}