<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class categoryModel{
    // recuperer tous les category
    public function getCategories(){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `category`";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    // ajouter une category
    public function addCategory($data){
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `category`(`name`) VALUES (?)");
        $query->execute(array($data["name"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }
}