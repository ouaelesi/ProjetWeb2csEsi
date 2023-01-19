<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/swiperModel.php');

class swiperController{

    public function getSwiper(){
       $swiperModel = new swiperModel() ; 
       $response = $swiperModel->getSwiper() ; 
       return $response ; 
    }

    public function addSlide(){
       $swiperModel = new swiperModel() ; 
       $swiperModel->addSlide($_POST) ; 
       return ; 
    }
}