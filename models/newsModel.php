<?php

class newsModel
{
    // recuperer les news 
    public function getNews()
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from news join post on news.postID=post.id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $recipe) {
            array_push($response, $recipe);
        }
        echo var_dump($response);
        $database->disconnect($db);
        return $response;
    }

    // ajouter des news 
    public function addNews($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`title`, `description` , `type` , `coverImage` , `cardImage` , `video` , `event` , `status` , `createdBy`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data["title"], $data["description"], $data["type"], $data["coverImage"], $data["cardImage"], $data["video"], $data["event"], 'pending', 1));

        // add the recipe 
        $postID = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO `news`(`tags`, `postID`) VALUES (?,?,?,?,?)");
        $query->execute(array($data["preparationTime"], $postID));

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // get news by Id 
    public function getNewsById($idNews)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from news join post on news.postID=post.id where recette.id=$idNews";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $news) {
            array_push($response, $news);
        }
        $database->disconnect($db);
        return $response;
    }

    // update news 
    public function updateNews()
    {
    }


    // 
    public function getNbNews()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT count(*) nbNews from news";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }
}
