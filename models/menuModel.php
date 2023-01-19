<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");
class menuModel
{
    public function getMenu($page)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from menu where `page`='" . $page . "'";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $menu) {
            // Get the menu Link
            $query = "SELECT * from link where `menuID`='" . $menu["id"] . "'";
            $link = $database->request($db, $query);

            // Get the menu social Media 
            $query = "SELECT * from socialmedia where `menuID`='" . $menu["id"] . "'";
            $socialMedia = $database->request($db, $query);

            // Add the links and the social media to the menu
            $menu["links"] = $link;
            $menu["socialmedia"] = $socialMedia;

            array_push($response, $menu);
        }
        return $response;
    }


    public function addLink($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `link`(`name` , `type` , `href` , `icon` , `menuID`) VALUES (? , ? , ? , ?,?)");
        $query->execute(array($data["name"], 'link', $data["href"], '',  $data["menuID"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function addSocilaMedia($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `socialmedia`(`name` , `icon` ,`href` , `menuID`) VALUES (? , ? , ?)");
        $query->execute(array($data["name"], $data["icon"], $data["href"], $data["menuID"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }


    public function getLogo($page)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT logo from menu where `page`='" . $page . "'";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    public function changeLogo($menuID){
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `menu` SET `logo`=?  WHERE id=?');
        $query->execute(array($_FILES['logoPic']['name'], $menuID));
        
        // upload the card Image 
        $recipeModel = new recipeModel() ; 
        $recipeModel->uploadImage('logoPic', '/public/logos/');

        $database->disconnect($db);  
    }
}
