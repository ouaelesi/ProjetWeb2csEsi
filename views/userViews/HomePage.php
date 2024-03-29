<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/swiperController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
class HomePage
{
    // display Swiper
    public function swiper($type)
    {
        $swiperController = new swiperController();
        $data = $swiperController->getSwiper();

?>
        <!-- Carousel -->
        <div id="carouselExampleSlidesOnly" class="carousel slide swiperHeader" data-bs-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                <?php
                foreach ($data as $slide) {
                ?>
                    <div class="carousel-item position-relative swiperItem <?php if ($slide["id"] == "1") echo "active" ?>">
                        <img src="/ProjetWeb/public/images/swiperHeader/<?php echo $slide['image'] ?>" class="d-block w-100 position-absolute" alt="...">
                        <div class="position-relative">
                            <div class="poition-relative swiperContent " <?php if ($type == 'admin') echo 'style="transform: scale(0.6); transform-origin: top left; width:100% !important;"'  ?>>
                                <p class="swiperTitle text-white " > <?php echo $slide["title"] ?><br /><span>Now!</span></p>
                                <p class="swiperDescription text-white w-100"><?php echo $slide["description"] ?></p>
                                <button class="btn btn-red px-5 py-2 font-xl mt-3" onclick="gotoUrl('/ProjetWeb/ideas')"> Start Now</button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    <?php
    }

    public function categorySwipers()
    {
        $categoryController = new categoryController();
        $categories = $categoryController->getCategories();
        foreach ($categories as $category) {
            $this->categorySwiper($category);
        }
    }
    // display swiper Slide 
    public function categorySwiper($category)
    {
        $recipecontroller = new recipeController();
        $recipes = $recipecontroller->getrecipesByCateg($category["id"]);
    ?>
        <div class="ctgSwiperTitle text-center"><?php echo $category['name'] ?></div>

        <section class="image-slider-container mb-5">
            <div class="image-slider-heading">
                <h2 class="image-slider-title">
                    recette populaires 🤩
                </h2>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($recipes as $recipe) {
                        $this->recipeCard($recipe, $category['name']);
                    }
                    ?>
                </div>

            </div>
            <a href="/ProjetWeb/categories?id=<?php echo $category['name'] ?>" class="text-center py-2 text-decoration-none text-light mx-auto d-block mt-4">Afficher Plus..</a>
        </section>
    <?php
    }
    // display cards Swiper 
    public function recipeCard($recipe, $category)
    {
        $userController = new userController();
        $isLike = $userController->userIsLikeRecipe($recipe[0]);
    ?>

        <div class="swiper-slide" onclick="gotoUrl('/ProjetWeb/recette?id=<?php echo $recipe[0] ?>')">
            <div class="blurEffect opacity-50"></div>
            <div class="slide-con p-1 bluredBox">
                <div class="cardImage">
                    <img src="/ProjetWeb/public/images/recipeImages/<?php echo $recipe['cardImage'] ?>" />
                    <div class="position-relative d-flex justify-content-between p-1">

                        <div class="categoryCard text-white"><?php echo $category ?></div>
                        <div id="heartContainer" class="likeCard " onclick="window.event.cancelBubble = true; likeRecipe(this , <?php echo $recipe[0] ?>)"> <img src="/ProjetWeb/public/icons/<?php if (!$isLike) {
                                                                                                                                                                                                    echo 'heart.png';
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo 'fullheart.png';
                                                                                                                                                                                                } ?>" width="65%" class="mx-auto d-block mt-2" id="likeimage" /></div>
                    </div>
                </div>
                <div class="cardContent ">
                    <p class="h5 cardTitle"><?php echo $recipe["title"] ?></p>
                    <p class="h6 cardDescription"><?php echo $recipe["description"] ?></p>
                    <div class="d-flex justify-content-between">
                        <div class="recipeCardStats">
                            <div class=""><?php if ($recipe["note"] != null) echo number_format($recipe["note"], 2, '.', ',');
                                            else echo "0" ?>/5 <img src="/ProjetWeb/public/icons/Yellow_Star.png" width="18px" class="mx-1" /></div>
                            <span><?php echo $recipe["preparationTime"] ?> min</span>
                        </div>
                        <button class="btn btn-red card-btn">See more</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    // display home page 
    public function displayHome()
    {
        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // carousel
        $this->swiper("");
        // navLinks 
        $sharedComponents->navLinks();
        // swipers 
        $this->categorySwipers();
        // Footer 
        $sharedComponents->Footer();
    }
}
