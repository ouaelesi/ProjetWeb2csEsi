<?php

class newsPage
{

    public function addNewsForm()
    {
?>
        <div class="bluredBox px-3 pt-4 pb-2   mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Information Génerale
            </div>
            <form class="row" action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                <div class="my-2 col-6">
                    <label class="mb-1">Titre</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="title" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Description</label>
                    <textarea class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="description"></textarea>
                </div>

                <div class="my-2 col-6">
                    <label class="mb-1">Tags </label>
                    <input name="tags" placeholder="tag1, tag2, tag3 ..." type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Fete </label>

                    <select name="event" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light">
                        <option value="0">aucune</option>
                        <?php
                        $eventsController = new eventsController();
                        $events = $eventsController->getEvents();
                        foreach ($events as $event) {
                        ?>
                            <option value="<?php echo $event["id"] ?>"><?php echo $event["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Image de couverture</label>
                    <input name="coverImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Image du carte </label>
                    <input name="cardImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Video </label>
                    <input name="video" placeholder="video" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>

                <div>
                    <button class="btn btn-yellow d-block ms-auto px-4 my-3" type="submit" name="addNews">Ajouter News</button>
                </div>
            </form>
        </div>
    <?php
    }


    public function newsList()
    {
        $newsController = new newsController();
        $news = $newsController->getNews();
    ?>
        <table data-search="true" data-toggle="table" class="table-style">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">
                    <th data-sortable="true" class="col-4">nom</th>
                    <th data-sortable="true" class="col-2">Event</th>
                    <th data-sortable="true" class="col-3">Status</th>
                    <th data-sortable="true" class="col-3">management</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($news as $new) {
                    $eventController = new eventsController();
                    $event = $eventController->getEventByID($new['event']);

                ?>
                    <tr class="d-flex bluredBox  rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $new[0] ?>')">
                        <td class="col-4 text-light "><a href="/ProjetWeb/article?id=<?php echo $new[0] ?>" class="text-light"><?php echo $new['title'] ?></a></td>
                        <td class="col-2 text-center text-light "><?php echo $event['name'] ?></td>
                        <td class="col-3 text-light ">
                            <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($new['status'] == 'valid') echo 'bg-success';
                                                                                            else if ($new['status'] == 'rejected') echo 'bg-danger';
                                                                                            else echo 'bg-warning' ?>"><?php echo $new['status'] ?></div>
                        </td>
                        <td class=" text-light col-3 d-flex justify-content-center gap-3 "><button class="btn btn-yellow" onclick="gotoUrl('/ProjetWeb/admin/editnews?id=<?php echo $new[0] ?>')">Edit</button> <button class="btn btn-red">Supprimer</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


    <?php
    }
    public function newsHeader()
    {
        $sharedViews = new sharedadminView();
    ?>
        <div class="d-flex justify-content-between">
            <div>
                <?php $sharedViews->pageHeader('Gestion des News'); ?>
            </div>
            <div>
                <button class="btn btn-red" onclick="gotoUrl('/ProjetWeb/admin/addnews')"> Ajouter un News </button>
            </div>
        </div>
    <?php
    }

    public function editnewsForm()
    {
        $newscontroller = new newsController();
        $news = $newscontroller->getNewsById($_GET['id']);
    ?>
        <div class="bluredBox px-3 pt-4 pb-2   mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Information Génerale
            </div>
            <form class="row" action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                <div class="my-2 col-6">
                    <label class="mb-1">Titre</label>
                    <input value="<?php echo $news['title'] ?>" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="title" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Description</label>
                    <textarea class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="description"> <?php echo $news['description'] ?></textarea>
                </div>

                <div class="my-2 col-6">
                    <label class="mb-1">Tags </label>
                    <input value="<?php echo $news['tags'] ?>" name="tags" placeholder="tag1, tag2, tag3 ..." type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">fete </label>

                    <select name="event" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light">
                    <option value="0">aucune</option>
                        <?php
                        $eventsController = new eventsController();
                        $events = $eventsController->getEvents();
                        foreach ($events as $event) {
                        ?>
                            <option <?php if ($news['title'] == $event['id']) echo 'selected' ?> value="<?php echo $event["id"] ?>"><?php echo $event["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- <div class="my-2 col-6">
                    <label class="mb-1">Image de couverture</label>
                    <input name="coverImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div>
                <div class="my-2 col-6">
                    <label class="mb-1">Image du carte </label>
                    <input name="cardImage" type="file" required class="bluredBox px-2 py-1 d-block rounded-1 w-100 text-light" />
                </div> -->
                <div class="my-2 col-6">
                    <label class="mb-1">Video </label>
                    <input value="<?php echo $news['video'] ?>" name="video" placeholder="video" type="text" required class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" />
                </div>
                <input hidden value="<?php echo $news[0] ?>" name="newsId" />
                <div>
                    <button class="btn btn-yellow d-block ms-auto px-4 my-3" type="submit" name="editNews">save changes</button>
                </div>
            </form>
        </div>
<?php
    }





    // --------------------------------------------------
    public function displayNewsPage()
    {
        // header 
        $this->newsHeader();
        // add recipe form 
        $this->newsList();
    }

    public function displayaddNewsPage()
    {
        $sharedViews = new sharedadminView();
        $sharedViews->pageHeader('Ajouter un news', 'food.jpg');

        $this->addNewsForm();
    }

    //-------------------------------------
    public function displayEditNewsPage()
    {
        $sharedViews = new sharedadminView();
        $sharedViews->pageHeader('Modifier news');

        $this->editnewsForm();
    }
}
