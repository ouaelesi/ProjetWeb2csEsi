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
        $res = $query->execute(array($_POST['recetteID'], $_COOKIE["logedIn_user"],  $_POST['note']));
        if (!$res) {
            $query = $db->prepare('UPDATE `rating` SET `note`=? WHERE userID=? and recetteID=?');
            $query->execute(array($_POST['note'], $_COOKIE["logedIn_user"], $_POST['recetteID']));
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

        $query = $db->prepare("INSERT INTO `like` (`recetteID` , `userID`) VALUES (? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function userIsSaveNews($newsId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $cookie_name = "logedIn_user";
        if (!isset($_COOKIE[$cookie_name])) {
            return false;
        }
        $query = "SELECT * from `save` where userID=$_COOKIE[$cookie_name] and newsID=$newsId";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        if (sizeof($response) > 0) {
            return  true;
        } else {
            return false;
        }
        return;
    }

    // get user like 
    public function userIsLikeRecipe($recipeId)
    {

        $database = new dataBaseController();
        $db  = $database->connect();
        $cookie_name = "logedIn_user";
        if (!isset($_COOKIE[$cookie_name])) {
            return false;
        }
        $query = "SELECT * from `like` where userID=$_COOKIE[$cookie_name] and recetteID=$recipeId";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        if (sizeof($response) > 0) {
            return  true;
        } else {
            return false;
        }
        return;
    }

    // save news 
    public function saveNews($idUser, $idPost)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `save`(`newsID` , `userID`) VALUES (? , ?)");
        $query->execute(array($idPost, $idUser));

        unset($_POST);
        $database->disconnect($db);
        return;
    }


    public function getUserById($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT id,firstName,lastName,email,photo,dateOfBirth,sex,`status`,`role` from user where id=$userId";
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
            $cookie_value = $db->lastInsertId();
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        } catch (Exception $err) {
            echo var_dump($err);
        }

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function logIn($email, $password)
    {

        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `user` where email='$email' and `password`='$password'";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        if (sizeof($response) > 0) {;
            $cookie_name = "logedIn_user";
            // $cookie_value = ["firstName" => $_POST['firstName'], "lastName" => $_POST['lasteName'], "role" => $_POST['role'], "id" => $db->lastInsertId(), "email" => $_POST['email']];
            $cookie_value = $response[0]['id'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            return $response[0];
        } else return [];
    }


    // user stats 

    public function userStats($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT (SELECT count(*)from `like` where userID=$userId)as likes , (SELECT count(*) from `rating` where userID=$userId)as rating ,(SELECT count(*) from `comment` where userID=$userId)as comments ,(SELECT count(*) posts from `post` where createdBy=$userId)as posts;";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    // get favourite posts 

    public function getVafouritePosts($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT recette.* , post.* , AVG(rating.note) note from ((recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID) join `like` on like.recetteID=recette.id where like.userID=$userId GROUP BY recette.id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }


    public function getUserAddedRecipes($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT recette.* , post.* , AVG(rating.note) note from ((recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID)  where post.createdBy=$userId GROUP BY recette.id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }


    public function getNbUsers()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT count(*) nbUsers from user";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }

    public function getallUser()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT * from user";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }

    public function validateAccount($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `user` SET `status`=? WHERE id=?');
        $query->execute(array("valid", $userId));

        $database->disconnect($db);
    }

    public function rejectAccount($userId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `user` SET `status`=? WHERE id=?');
        $query->execute(array("rejected", $userId));

        $database->disconnect($db);
    }

    public function updateProfile($userId, $firstName, $lastName, $email)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `user` SET `firstName`=? , `lastName`=?, `email`=? WHERE id=?');
        $query->execute(array($firstName, $lastName, $email, $userId));
        
        $database->disconnect($db);
    }
    public function profilePic($userId){
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `user` SET `photo`=?  WHERE id=?');
        $query->execute(array($_FILES['profilePic']['name'], $userId));
        
        // upload the card Image 
        $recipeModel = new recipeModel() ; 
        $recipeModel->uploadImage('profilePic', '/public/images/profile/');

        $database->disconnect($db);  
    }
}
