<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/menuModel.php');
class menuController
{
    public function getMenu($page)
    {
        $menuModel = new menuModel();
        $response = $menuModel->getMenu($page);
        return $response;
    }

    public function addLink()
    {
        $menuModel = new menuModel();
        $menuModel->addLink($_POST);
        return;
    }

    public function addSocilaMedia()
    {
        $menuModel = new menuModel();
        $menuModel->addSocilaMedia($_POST);
        return;
    }

    public function getLogo($page)
    {
        $menuModel = new menuModel();
        $response = $menuModel->getLogo($page);
        return $response[0];
    }

    public function changeLogo()
    {
        $menuModel = new menuModel();
        $response = $menuModel->changeLogo($_POST['menuID']);
        return $response[0];
    }
}
