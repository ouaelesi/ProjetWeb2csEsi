<?php
class newsView
{
    public function newsList($posts)
    {
        $homeViews = new HomePage();
        $categoryController = new categoryController();
?>
        <div class="row justify-content-md-center container  mx-auto ">
            <div class="px-4 mt-4">Results: <?php echo sizeof($posts) ?> recettes et news</div>
            <?php
            foreach ($posts as $post) {
            ?>
                <div class="col-3 mt-3 mb-5">
                    <?php
                    $this->postcard($post);
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }



    public function postcard($post)
    {
        if ($post['type'] == 'recette') {
            $homeViews = new HomePage();
            $recipeController = new recipeController();
            $recipe = $recipeController->getRecipeByPost($post['id']);
            $homeViews->recipeCard($recipe, "");
        } else {
            $newsController = new newsController();
            $news = $newsController->getNewsByPost($post['id']);
            $this->newsCard($news);
        }

    ?>
    <?php
    }

    public function newsCard($news)
    {
        $userController = new userController();
        $isLike = $userController->userIsSaveNews($news[0]);
    ?>

        <div class="swiper-slide" onclick="gotoUrl('/ProjetWeb/article?id=<?php echo $news[0] ?>')">
            <div class="blurEffect"></div>
            <div class="slide-con p-1">
                <div class="cardImage">
                    <img src="/ProjetWeb/public/images/newsImages/<?php echo $news['cardImage'] ?>" />
                    <div class="position-relative d-flex justify-content-between p-1">

                        <div class="categoryCard border-warning text-warning">News</div>
                        <div id="saveContainer" class="likeCard " onclick="window.event.cancelBubble = true; saveNews(this , <?php echo $news[0] ?>)"> <img src="/ProjetWeb/public/icons/<?php if (!$isLike) {
                                                                                                                                                                                                echo 'save.png';
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo 'saved.png';
                                                                                                                                                                                            } ?>" width="65%" class="mx-auto d-block mt-2" id="saveImage" /></div>
                    </div>
                </div>
                <div class="cardContent ">
                    <p class="h5 cardTitle"><?php echo $news["title"] ?></p>
                    <p class="h6 cardDescription"><?php echo $news["description"] ?></p>
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <button class="btn btn-red card-btn">See more</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    public function displayNewsPage()
    {
        $sharedComponents = new sharedViews();
        $newsController = new newsController();
        $posts = $newsController->getPosts();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Page des News' , "food.jpg");
        // navLinks 
        $sharedComponents->navLinks();
        // 
        $this->newsList($posts);
    }

    public function newsBlog($news)
    {
        $userController = new userController();
        $isLike = $userController->userIsSaveNews($news[0]);
    ?>
        <div class="w-50 mx-auto mb-5">
            <div class="">
                <img src="/ProjetWeb/public/images/newsImages/<?php echo $news['coverImage'] ?>" class="rounded-3 d-block ml-auto mt-3" width="100%" />
            </div>
            <div class="h1 mt-4">
                <?php echo $news['title'] ?>
            </div>
            <div class="h6 mt-4 text-warning d-flex justify-content-between">
                <span> <?php echo $news['tags'] ?></span>
                <div onclick="    saveNews(this , <?php echo $news[0] ?>)"><img role="button" src="/ProjetWeb/public/icons/<?php if (!$isLike) {
                                                                                                                                echo 'save.png';
                                                                                                                            } else {
                                                                                                                                echo 'saved.png';
                                                                                                                            } ?>" width="30px" class="" id="saveImage" /> </div>
            </div>
            <div class="">
                <div class="">
                    <p class="recipeBigDescription">
                        <?php echo $news['description'] ?>
                    </p>
                </div>

            </div>
            <div class="my-5">
                <iframe width="100%" height="455" src="<?php echo $news['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>


<?php
    }

    public function singleNewsPage()
    {
        $sharedComponents = new sharedViews();
        $newsController = new newsController();
        $news = $newsController->getNewsById($_GET['id']);
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader($news['title'],'food.jpg');
        // navLinks 
        $sharedComponents->navLinks();
        // news article 
        $this->newsBlog($news);
        // The footer 
        $sharedComponents->Footer();
    }
}
