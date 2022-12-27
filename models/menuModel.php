<?php
require_once "./controllers/dataBaseController.php";
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

    
    public function addLink($data){
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `link`(`name` , `type` , `href` , `icon` , `menuID`) VALUES (? , ? , ?)");
        $query->execute(array($data["name"], $data["type"], $data["href"] , $data["icon"] ,  $data["menuID"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function addSocilaMedia($data){
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `socialmedia`(`name` , `icon` ,`href` , `menuID`) VALUES (? , ? , ?)");
        $query->execute(array($data["name"], $data["icon"] , $data["href"] , $data["menuID"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }


}
