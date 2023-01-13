<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/newsModel.php');

class newsController
{
    // recuperer les news 
    public function getNews()
    {
        $newsModel = new newsModel();
        $response = $newsModel->getNews();
        return $response;
    }

    // ajouter des news 
    public function addNews()
    {
        $newsModel = new newsModel();
        $newsModel->addNews($_POST);
        return;
    }

    // get news by Id 
    public function getNewsById()
    {
        $newsModel = new newsModel();
        $newsModel->getNewsById($_POST);
        return;
    }

    // update news 
    public function updateNews()
    {
    }

    public function getNbNews()
    {
        $newsModel = new newsModel();
        $response = $newsModel->getNbNews();
        return $response[0];
    }
}
