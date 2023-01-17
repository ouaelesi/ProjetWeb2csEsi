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
    public function getNewsById($id)
    {
        $newsModel = new newsModel();
        $response = $newsModel->getNewsById($id);
        return $response[0];
    }

    public function getNewsByPost($id)
    {
        $newsModel = new newsModel();
        $response = $newsModel->getNewsByPost($id);
        return $response[0];
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

    public function getPosts()
    {
        $newsModel = new newsModel();
        $response = $newsModel->getPosts();
        return $response;
    }
}
