<?php

class stepModel{

    public function addStep($data){

    }

    public function getrecipeSteps($recipe_id){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `step` where recetteID=$recipe_id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $ingredient) {
            array_push($response, $ingredient);
        }
        $database->disconnect($db);
        return $response;
    }

    public function deleteStep($step_id){

    }

    public function getStepById($step_id){
        
    }
}