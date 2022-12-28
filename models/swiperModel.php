<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/dataBaseController.php");

class swiperModel{

    public function getSwiper(){
        $database = new dataBaseController() ; 
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
}