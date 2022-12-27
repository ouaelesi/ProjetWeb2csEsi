<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class recipeModel
{
    // recuperer tous les recette 
    public function getRecipes()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from recette join post on recette.postID=post.id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    // ajouter une recette 
    public function addRecipe($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`title`, `description` , `type` , `coverImage` , `cardImage` , `video` , `event` , `status` , `createdBy`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data["title"], $data["description"], $data["type"], $data["coverImage"], $data["cardImage"], $data["video"], $data["event"], 'pending', 1));

        // add the recipe 
        $postID = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO `recette`(`preparationTime`, `cookTime`, `restTime` ,`categoryID` ,  `postID`) VALUES (?,?,?,?,?)");
        $query->execute(array($data["preparationTime"], $data["cookTime"], $data["restTime"], $data["category"] ,  $postID));

        unset($_POST);
        $database->disconnect($db);
        return;
    }
    
   // valider l'ajout d'une recette 
    public function validateRecipe($id){

        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `post` SET `status`=? WHERE id=?');
        $query->execute(array("valid", $id));

        $database->disconnect($db);
    }

    // Modifier la recette 
    public function updateRecipe($id){
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `post` SET `status`=? WHERE id=?');
        $query->execute(array("valid", $id));

        $database->disconnect($db);
    }

    // recuperer une recette specifique 
    public function getRecipe($id){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from recette join post on recette.postID=post.id where recette.id=$id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    // filtrer les recettes selon la category
    public function getrecipesByCateg($idCateg){
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT * from recette join post on recette.postID=post.id where categoryID=$idCateg";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }

        $database->disconnect($db);

        return $response;
    }

    
}
