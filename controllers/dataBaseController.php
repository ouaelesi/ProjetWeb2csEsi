<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/dbModel.php');
class dataBaseController{
    public function connect(){
        $dbModel = new dbModel() ; 
        return $dbModel->connect(); 
    }
    public function disConnect($db){

    }

    public function request($db , $query){
        $dbModel = new dbModel() ; 
        return $dbModel->request($db , $query); 
    }
}