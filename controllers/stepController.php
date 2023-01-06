<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/stepModel.php');

class stepController
{

    public function getrecipeSteps($recipeId)
    {
        $stepModel = new stepModel();
        $response = $stepModel->getrecipeSteps($recipeId);
        // echo var_dump($response) ; 
        return $response; 
    }
}