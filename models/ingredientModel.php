<?php

class ingredientModel
{
    public function getIngredients()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `ingredient`";
        $res = $database->request($db, $query);
        return $res;
    }

    public function addIngredient($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `ingredient`(`name` , `healthy` , `season` , `calories`) VALUES (? , ? , ? ,?)");
        $query->execute(array($data["name"], $data["healthy"], $data["season"], $_POST['calories']));

        // add the informations 
        $ingredientID = $db->lastInsertId();
        $informations = $this->getInformations();
        foreach ($informations as $info) {
            $query = $db->prepare("INSERT INTO `contientinfos`(`ingredientID` , `informationID` , `quantity` ) VALUES (? , ? , ? )");
            $query->execute(array($ingredientID, $info['id'], $data[$info["name"]]));
        }
        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function getRecipeIngredients($recipeID)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `ingredient` join `contient` on ingredient.id=contient.ingredientID where recetteID=$recipeID";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $ingredient) {
            array_push($response, $ingredient);
        }
        $database->disconnect($db);
        return $response;
    }

    public function getNbIgredients()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT count(*) nbIngredients from ingredient";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }

    public function getInformations()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT * from information";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }

    public function editIngredient($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `ingredient` SET `name`=?, `healthy`=?, `season`=? , `calories`=? WHERE id=?');
        $query->execute(array($_POST['name'], $_POST['healthy'], $_POST['season'], $_POST['calories'], $id));

        $database->disconnect($db);
    }

    public function deleteIngredient($id){
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('DELETE FROM `ingredient` WHERE id=?');
        $query->execute(array($id));

        $database->disconnect($db);
    }
}
