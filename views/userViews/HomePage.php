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
        <div id="carouselExampleSlidesOnly" class="carousel slide swiperHeader" data-bs-ride="carousel" data-interval="10000">
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

        <section class="image-slider-container">
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
                        
                        $this->recipeCard($recipe);
                    }
                    ?>
                </div>

            </div>
        </section>
    <?php
    }
    // display cards Swiper 
    public function recipeCard($recipe)
    {
    ?>

        <div class="swiper-slide">
            <div class="slide-con">
                <div class="cardImage"> 
                <img src="public/images/recipeImages/<?php echo $recipe['cardImage'] ?>" />
                </div>
                <div class="cardContent">
                <p class="h4"><?php echo $recipe["title"] ?></p>
                <p class="h6 cardDescription"><?php echo $recipe["description"] ?></p>
                <button class="btn btn-red card-btn ">See more</button>
                </div>
         
    
            </div>
        </div>
<?php
    }
    // display home page 
    public function displayHome()
    {
        $sharedComponents = new sharedViews();
        $sharedComponents->NavBar(null);
        // nav Bar

        // carousel
        $this->swiper();
        // navLinks 
        $sharedComponents->navLinks();
        // swiper des Entrées 
        $this->categorySwipers();
        // swiper des plats

        // swiper des dessert 

        // swiper des boissons 

        // Footer 
        $sharedComponents->Footer();
    }
}
