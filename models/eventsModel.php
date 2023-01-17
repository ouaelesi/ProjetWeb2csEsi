<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class eventsModel
{
    public function getEvents()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `event`";
        $res = $database->request($db, $query);
        return $res;
    }

    // ajouter un evenement
    public function addEvent($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `event`(`name` , `description` , `date`) VALUES (? , ? , ?)");
        $query->execute(array($data["name"], $data["description"], $data["date"]));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    public function getEventByID($id){
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from `event` where id=$id";
        $res = $database->request($db, $query);
        return $res;
    }
}
