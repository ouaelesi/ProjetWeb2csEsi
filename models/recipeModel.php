<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class recipeModel
{
    public function getStyle()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT * from `style` where id=1";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        $database->disconnect($db);
        return $response[0];
    }
    // recuperer tous les recette 
    public function getRecipes($params)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $style = $this->getStyle();

        $whereConditions = 'WHERE 1=1';
        $havingConditions = 'HAVING 1=1';
        $searchParams = null;



        if (!$_COOKIE['logedIn_user']) {
            $whereConditions = $whereConditions . " AND `status`='valid'";
        } else {
            $userModel = new userController();
            $user = $userModel->getUserById($_COOKIE['logedIn_user']);

            if ($user['role'] != "admin") {
                $whereConditions = $whereConditions . " AND `status`='valid'";
            }
        }
        // search 
        if (sizeof($params) > 0 and $params["search"] != "null" and $params["search"] != "") {
            $searchParams = $params['search'];
            $searchParams = substr($searchParams, 0, -1);
            $searchParams = str_replace('-', ',', $searchParams);
            $nbParams = sizeof(explode(',', $searchParams)) * $style['seuil'];
            // error_log($searchParams)  ; 

            $query = "(SELECT recetteID FROM `contient` WHERE ingredientID IN ($searchParams) GROUP BY recetteID HAVING COUNT(recetteID)>=$nbParams)";
            $whereConditions = $whereConditions . ' AND recette.id IN ' . $query;
        }

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
            && $imageFileType != "gif" && $imageFileType != "webp"
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
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`title`, `description` , `type` , `coverImage` , `cardImage` , `video` , `event` , `status` , `createdBy`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data["title"], $data["description"], 'recette', $_FILES["coverImage"]['name'], $_FILES["cardImage"]["name"], $data["video"], $data["event"], 'pending', $_COOKIE["logedIn_user"]));

        // add the recipe 
        $postID = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO `recette`(`preparationTime`, `cookTime`, `restTime` ,`categoryID` ,  `postID` , `cookMethode` , `difficulty`) VALUES (?,?,?,?,?,?,?)");
        $query->execute(array($data["preparationTime"], $data["cookTime"], $data["restTime"], $data["category"],  $postID, $data['cookMethode'], $data['difficulty']));

        // upload the card Image 
        $this->uploadImage('cardImage', '/public/images/recipeImages/');
        // upload the civer Image 
        $this->uploadImage('coverImage', '/public/images/recipeImages/');

        unset($_POST);
        $database->disconnect($db);
        return $db->lastInsertId();
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
    public function rejectRecipe($id)
    {

        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `post` SET `status`=? WHERE id=?');
        $query->execute(array("rejected", $id));

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

    public function addIngredientToRecipe()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `contient`(`recetteID`, `ingredientID` , `quantity` ) VALUES (?,?,?)");
        $query->execute(array($_POST["recetteID"], $_POST["ingredientID"], $_POST["quantity"]));
        $database->disconnect($db);
        return;
    }
    public function addStepToRecipe()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `step`(`title`, `description` , `recetteID` ) VALUES (?,?,?)");
        $query->execute(array($_POST["title"], $_POST["description"], $_POST["recetteID"]));


        $database->disconnect($db);
        return;
    }

    public function getEventsRecipes($params)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $whereConditions = 'WHERE `event`!="null"';

        // les conditions de la category
        if (sizeof($params) > 0 and $params["fete"] != "null" and $params["fete"] != "all") {
            $whereConditions = $whereConditions . ' AND `event`=' . $params["fete"];
        }

        $query = "SELECT recette.* , post.* , AVG(rating.note) note,cookTime+preparationTime+restTime totalTime from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID $whereConditions GROUP BY recette.id ORDER BY note DESC";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    public function getSeasonRecipes($params)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $whereConditions = 'WHERE 1=1';
        $limit = '';

        // les conditions de la category
        if (sizeof($params) > 0 and $params["season"] != "null" and $params["season"] != "") {
            $whereConditions = $whereConditions . ' AND `season`="' . $params["season"] . '"';
        }
        if (sizeof($params) > 0 and $params["limit"] != "null" and $params["limit"] != "") {
            $limit = $limit . 'limit ' . $params["limit"];
        }


        $query = "SELECT recette.* , post.* , AVG(rating.note) note,cookTime+preparationTime+restTime totalTime from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID WHERE recette.id in (SELECT * from (SELECT recetteID FROM `ingredient` join contient on contient.ingredientID = ingredient.id $whereConditions GROUP BY contient.recetteID  ORDER By count(*) DESC $limit) recipes) GROUP BY recette.id ORDER BY note DESC";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }


    public function getRecipeByPost($postId)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT recette.* , post.* , AVG(rating.note) note,cookTime+preparationTime+restTime totalTime from (recette join post on recette.postID=post.id) left JOIN rating on recette.id=rating.recetteID where postID=$postId GROUP BY recette.id ORDER BY note DESC";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    public function deleterecipe($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('DELETE FROM `recipe` WHERE id=?');
        $query->execute(array($id));

        $database->disconnect($db);
    }


    public function editrecipe()
    {
        $recipeController = new recipeController();
        $recipe = $recipeController->getRecipe($_POST['recetteID']);
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `recette` SET `cookTime`=? , `preparationTime`=? , `restTime`=? , `categoryID`=? , `cookMethode`=?, `difficulty`=? WHERE id=?');
        $query->execute(array($_POST['cookTime'], $_POST['preparationTime'], $_POST['restTime'], $_POST['category'], $_POST['cookMethode'], $_POST['difficulty'], $_POST['recetteID']));

        $query = $db->prepare('UPDATE `post` SET `title`=? , `description`=? , `event`=? , `video`=? WHERE id=?');
        $query->execute(array($_POST['title'], $_POST['description'], $_POST['event'], $_POST['video'], $recipe['postID']));

        $database->disconnect($db);
    }

    public function addComment()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare("INSERT INTO `comment`(`postID`, `userID`, `commentText`) VALUES (?,?,?)");
        $query->execute(array($_POST["recetteID"], $_COOKIE["logedIn_user"], $_POST["comment"]));


        $database->disconnect($db);
        return;
    }

    public function getRecipeComments($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT * from comment where postID=$id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);

        return $response;
    }

    public function updateSeuil()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `style` SET `seuil`=? WHERE id=?');
        $query->execute(array($_POST['seuil'], 1));

        $database->disconnect($db);
    }
}
