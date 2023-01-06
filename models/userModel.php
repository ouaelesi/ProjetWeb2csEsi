<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");


class userModel
{

    // ajouter une note a une recette 
    public function rateRecipe($idUser, $idRecipe, $note)
    {

        $database = new dataBaseController();
        $db  = $database->connect();

        // add the post 
        $query = $db->prepare("INSERT INTO `rating`(`recetteID` , `userID` , `note`) VALUES (? , ? , ?)");
        $res = $query->execute(array($_POST['recetteID'], $_POST["userID"],  $_POST['note']));
        if (!$res) {
            $query = $db->prepare('UPDATE `rating` SET `note`=? WHERE userID=? and recetteID=?');
            $query->execute(array($_POST['note'], $_POST["userID"], $_POST['recetteID']));
        }

        echo json_decode("de");
    }

    public function getUserRecipeRating($userId, $recipeId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from rating where userID=$userId and recetteID=$recipeId";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    // ajouter un commentaire 
    public function commentPost($idUser, $idPost, $comment)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `comment`(`recetteID` , `userID` , `comment`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser,  $comment));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // like recette 
    public function likeRecette($idUser, $idPost)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `like`(`recetteID` , `userID`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // save news 
    public function saveNews($idUser, $idPost)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `save`(`recetteID` , `userID`) VALUES (? , ? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }


    public function getUserById($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT id,firstName,lastName from user j where id=$userId";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    public function createUser()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        try {
            $query = $db->prepare("INSERT INTO `user`(`role` , `firstName` , `lastName` , `dateOfBirth` , `sex` , `status` , `password` , `email` ) VALUES (? , ? , ?,? , ? , ?,? , ? )");
            $query->execute(array($_POST['role'], $_POST['firstName'], $_POST['lastName'], $_POST['dateOfBirth'], $_POST['sex'], "pending", $_POST['password'], $_POST['email']));

            $cookie_name = "logedIn_user";
            // $cookie_value = ["firstName" => $_POST['firstName'], "lastName" => $_POST['lasteName'], "role" => $_POST['role'], "id" => $db->lastInsertId(), "email" => $_POST['email']];
           $cookie_value = "Ouael" ; 
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            
        } catch (Exception $err) {
            echo var_dump($err);
        }

        unset($_POST);
        $database->disconnect($db);
        return;
    }
}
