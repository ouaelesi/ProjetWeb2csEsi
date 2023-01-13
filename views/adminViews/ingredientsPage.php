<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedAdminView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/ingredientController.php");

class ingredientsPage
{

    public function addIngredient(){
       ?>
       <div>
        
       </div>
       <?php
    }
    public function displayIngredientsPage()
    {
           // imports 
           $sharedViews = new sharedadminView();

           // page title
           $sharedViews->pageHeader('Gestion des nutritions');
   
    }
}
