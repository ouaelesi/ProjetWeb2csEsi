<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");


class userModel{

    // ajouter une note a une recette 
    public function rateRecipe($idUser , $idRecipe , $note){
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `rating`(`recetteID` , `userID` , `note`) VALUES (? , ? , ?)");
        $query->execute(array($idRecipe, $idUser,  $note));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // ajouter un commentaire 
    public function commentPost($idUser , $idPost , $comment){
        $database = new dataBaseController();
        $db  = $database->connect();
   
        $query = $db->prepare("INSERT INTO `comment`(`recetteID` , `userID` , `comment`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser,  $comment));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // like recette 
    public function likeRecette($idUser , $idPost ){
        $database = new dataBaseController();
        $db  = $database->connect();
 
        $query = $db->prepare("INSERT INTO `like`(`recetteID` , `userID`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

       // save news 
       public function saveNews($idUser , $idPost ){
        $database = new dataBaseController();
        $db  = $database->connect();
   
        $query = $db->prepare("INSERT INTO `save`(`recetteID` , `userID`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }
}