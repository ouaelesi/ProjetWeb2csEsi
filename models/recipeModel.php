<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class recipeModel
{
    // recuperer tous les recette 
    public function getRecipes($params)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $whereConditions = 'WHERE 1=1';
        $havingConditions = 'HAVING 1=1';

        // les conditions de la category
        if (sizeof($params) > 0 and $params["category"] != "null" and $params["category"] != "all") {
            $whereConditions = $whereConditions . ' AND categoryID=' . $params["category"];
        }

        // preparation time condictions 
        if (sizeof($params) > 0 and $params["preparationTime"] != "null" and $params["preparationTime"] != "all") {
            $whereConditions = $whereConditions . ' AND preparationTime>=' . explode("-", $params["preparationTime"])[0] . ' AND preparationTime< ' . explode("-", $params["preparationTime"])[1];
            // echo $whereConditions ; 
        }

        // cook time condictions 
        if (sizeof($params) > 0 and $params["cookTime"] != "null" and $params["cookTime"] != "all") {
            $whereConditions = $whereConditions . ' AND cookTime>=' . explode("-", $params["cookTime"])[0] . ' AND cookTime< ' . explode("-", $params["cookTime"])[1];
            // echo $whereConditions ; 
        }

        // total time condictions 
        if (sizeof($params) > 0 and $params["totalTime"] != "null" and $params["totalTime"] != "all") {
            $havingConditions = $havingConditions . ' AND totalTime>=' . explode("-", $params["totalTime"])[0] . ' AND totalTime< ' . explode("-", $params["totalTime"])[1];
        }

        // Les conditions de la note 
        if (sizeof($params) > 0 and $params["note"] != "null" and $params["note"] != "all") {
            $havingConditions = $havingConditions . ' AND note>=' . $params["note"];
            // echo $havingConditions;
        }

        $query = "SELECT recette.* , post.* , AVG(rating.note) note,cookTime+preparationTime+restTime totalTime from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID $whereConditions GROUP BY recette.id $havingConditions ORDER BY note DESC";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    public function uploadImage($image, $dir)
    {
        $target_dir =  $_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb' . $dir;
        $target_file = $target_dir . basename($_FILES[$image]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$image]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // // Check file size
        // if ($_FILES[$image]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$image]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES[$image]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // ajouter une recette 
    public function addRecipe($data)
    {
        echo var_dump($_POST);
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`title`, `description` , `type` , `coverImage` , `cardImage` , `video` , `event` , `status` , `createdBy`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data["title"], $data["description"], 'recette', $_FILES["coverImage"]['name'], $_FILES["cardImage"]["name"], $data["video"], $data["event"], 'pending', 1));

        // add the recipe 
        $postID = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO `recette`(`preparationTime`, `cookTime`, `restTime` ,`categoryID` ,  `postID`) VALUES (?,?,?,?,?)");
        $query->execute(array($data["preparationTime"], $data["cookTime"], $data["restTime"], $data["category"],  $postID));

        // upload the card Image 
        $this->uploadImage('cardImage', '/public/images/recipeImages/');
        // upload the civer Image 
        $this->uploadImage('coverImage', '/public/images/recipeImages/');

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // valider l'ajout d'une recette 
    public function validateRecipe($id)
    {

        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `post` SET `status`=? WHERE id=?');
        $query->execute(array("valid", $id));

        $database->disconnect($db);
    }

    // Modifier la recette 
    public function updateRecipe($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `post` SET `status`=? WHERE id=?');
        $query->execute(array("valid", $id));

        $database->disconnect($db);
    }

    // recuperer une recette specifique 
    public function getRecipe($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT recette.* , post.* , AVG(rating.note) note from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID WHERE recette.id=$id GROUP BY recette.id";

        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response;
    }

    // filtrer les recettes selon la category
    public function getrecipesByCateg($idCateg)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT recette.* , post.* , AVG(rating.note) note from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID  where categoryID=$idCateg GROUP BY recette.id ";

        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);

        return $response;
    }


    public function getHealthyRecipes($avg)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT recette.* , post.* , AVG(rating.note) note from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID  where recette.id in (SELECT contient.recetteID FROM `ingredient` JOIN contient on ingredient.id=contient.ingredientID WHERE healthy=1 GROUP BY contient.recetteID HAVING count(contient.recetteID)>=$avg) GROUP BY recette.id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);

        return $response;
    }

    public function getNbRecipes()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT count(*) nbRecipes from recette";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);

        return $response;
    }
}
