<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class swiperModel
{

    public function getSwiper()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from swiper join swiperslide on swiper.id=swiperslide.swiperID";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        // echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    public function addSlide($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `swiperslide`(`image`, `title`, `description`, `href`, `swiperID`, `type`) VALUES (? , ? , ? , ?,? ,?)");
        $query->execute(array($_FILES["photo"]['name'], $data['title'], $data["description"], '/',  $data["swiperID"], $data['type']));

        // upload the card Image 
        $recipeModel = new recipeModel();
        $recipeModel->uploadImage('photo', '/public/images/swiperHeader/');

        unset($_POST);
        $database->disconnect($db);
        return;
    }
}
