<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/eventsModel.php');

class eventsController
{
    public function getEvents()
    {
        $eventsModel = new eventsModel();
        $response = $eventsModel->getEvents();
        $res = array();
        foreach ($response as $event) {
            array_push($res, $event);
        }
        return $res;
    }

    public function getEventByID($id)
    {
        $eventsModel = new eventsModel();
        $response = $eventsModel->getEventByID($id);
        $res = array();
        foreach ($response as $event) {
            array_push($res, $event);
        }
        return $res[0];
    }
}
