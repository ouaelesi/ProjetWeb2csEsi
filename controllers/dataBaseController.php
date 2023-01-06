<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/dataBaseModel.php');
class dataBaseController{
    public function connect(){
        $dataBaseModel = new dataBaseModel() ; 
        return $dataBaseModel->connect(); 
    }
    public function disConnect($db){

    }

    public function request($db , $query){
        $dataBaseModel = new dataBaseModel() ; 
        return $dataBaseModel->request($db , $query); 
    }
}