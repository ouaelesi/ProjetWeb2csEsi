<?php

class ingredientModel{
    public function getIngredients(){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `ingredient`";
        $res = $database->request($db, $query);
        return $res;
    }

    public function addIngredient($data){
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`name` , `healthy` , `season`) VALUES (? , ? , ?)");
        $query->execute(array($data["name"], $data["healthy"], $data["date"]));
                
        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function getRecipeIngredients($recipeID){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `ingredient` join `contient` where recetteID=$recipeID";
        $res = $database->request($db, $query);
        return $res;
    }


}