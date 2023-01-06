<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/categoryModel.php');

class categoryController{
    // 
    public function getCategories(){
      $categoryModel =new categoryModel() ; 
      $response = $categoryModel->getCategories() ; 
      return $response ; 
    }
    public function getCategoryById($id){
      $categoryModel =new categoryModel() ; 
      $response = $categoryModel->getCategoryById($id) ; 
      return $response[0] ; 
    }
    // 
    // public function addCategory(){
    //   $recipeModel = new categoryModel() ;
    //   $response = $recipeModel->addCategory($_POST) ; 
    //   return $response ; 
    // }
}