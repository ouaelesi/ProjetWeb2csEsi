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
        $database->disconnect($db);
        return $response;
    }

    // ajouter des news 
    public function addNews($data)
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        // we need the upload method here 
        $recipeController = new recipeModel();

        // add the post 
        $query = $db->prepare("INSERT INTO `post`(`title`, `description` , `type` , `coverImage` , `cardImage` , `video` , `event` , `status` , `createdBy`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array($data["title"], $data["description"], 'news', $_FILES["coverImage"]['name'], $_FILES["cardImage"]["name"], $data["video"], $data["event"], 'pending', $_COOKIE["logedIn_user"]));

        // add the recipe 
        $postID = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO `news`(`tags`, `postID`) VALUES (?,?)");
        $query->execute(array($data["tags"], $postID));

        $recipeController->uploadImage('cardImage', '/public/images/newsImages/');
        // upload the civer Image 
        $recipeController->uploadImage('coverImage', '/public/images/newsImages/');

        unset($_POST);
        $database->disconnect($db);
        return;
    }

    // get news by Id 
    public function getNewsById($idNews)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from news join post on news.postID=post.id where news.id=$idNews";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $news) {
            array_push($response, $news);
        }
        $database->disconnect($db);
        return $response;
    }
    public function getNewsByPost($id)
    {
        $database = new dataBaseController();
        $db  = $database->connect();
        $query = "SELECT * from news join post on news.postID=post.id where postID=$id";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $news) {
            array_push($response, $news);
        }
        $database->disconnect($db);
        return $response;
    }

    // update news 
    public function editNews($idNews)
    {
        $newsController = new newsController();
        $news = $newsController->getNewsById($idNews);

        $database = new dataBaseController();
        $db  = $database->connect();

        $query = $db->prepare('UPDATE `news` SET `tags`=? WHERE id=?');
        $query->execute(array($_POST['tags'], $idNews));

        $query = $db->prepare('UPDATE `post` SET `title`=? , `description`=? , `event`=? , `video`=? WHERE id=?');
        $query->execute(array($_POST['title'], $_POST['description'], $_POST['event'], $_POST['video'], $news['postID']));

        $database->disconnect($db);
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

    public function getPosts()
    {
        $database = new dataBaseController();
        $db  = $database->connect();

        $query = "SELECT *  from post  ORDER BY title";
        $res = $database->request($db, $query);
        $response = array();
        foreach ($res as $user) {
            array_push($response, $user);
        }
        $database->disconnect($db);
        return $response;
    }
}
