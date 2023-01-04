<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/swiperController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
class HomePage
{
    // display Swiper
    public function swiper()
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
                        <img src="public/images/swiperHeader/<?php echo $slide['image'] ?>" class="d-block w-100 position-absolute" alt="...">
                        <div class="flex">
                            <div class="poition-relative swiperContent ">
                                <p class="swiperTitle">GET YOUR RECIPE <br /><span>Now!</span></p>
                                <p class="swiperDescription"><?php echo $slide["description"] ?></p>
                                <button class="btn btn-red px-5 py-2 font-xl mt-3"> Start Now</button>
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
            <a href="/ProjetWeb/reccettes/<?php echo $category['name'] ?>"  class="text-center py-2 text-decoration-none text-light mx-auto d-block mt-4">Afficher Plus..</a>
        </section>
    <?php
    }
    // display cards Swiper 
    public function recipeCard($recipe, $category)
    {
    ?>

        <div class="swiper-slide" onclick="gotoUrl('/ProjetWeb/recette?id=<?php echo $recipe['id'] ?>')">
            <div class="blurEffect"></div>
            <div class="slide-con p-1">
                <div class="cardImage">
                    <img src="public/images/recipeImages/<?php echo $recipe['cardImage'] ?>"  />
                    <div class="position-relative d-flex justify-content-between p-1">

                        <div class="categoryCard"><?php echo $category ?></div>
                        <div class="likeCard "> <img src="public/icons/heart.png" width="65%" class="mx-auto d-block mt-2" /></div>
                    </div>
                </div>
                <div class="cardContent">
                    <p class="h4"><?php echo $recipe["title"] ?></p>
                    <p class="h6 cardDescription"><?php echo $recipe["description"] ?></p>
                    <div class="d-flex justify-content-between">
                        <div class="recipeCardStats">
                        <div class=""><?php if($recipe["note"]!=null) echo number_format($recipe["note"], 2, '.', ','); else echo "-" ?> <img src="public/icons/Yellow_Star.png" width="18px" class="mx-1" /></div>
                        <span><?php echo $recipe["preparationTime"] ?> min</span>
                        </div>
               
                        <button class="btn btn-red card-btn ">See more</button>
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
        $this->swiper();
        // navLinks 
        $sharedComponents->navLinks();
        // swipers 
        $this->categorySwipers();
        // Footer 
        $sharedComponents->Footer();
    }
}
