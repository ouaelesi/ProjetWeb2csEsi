<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
class HomePage
{
    // display Swiper
    public function swiper()
    {
    }
    // display swiper Slide 
    public function swiperSlide()
    {
    }
    // display cards Swiper 
    public function cardSwiper($category, $posts)
    {
    }
    // display home page 
    public function displayHome()
    {
        $sharedComponents = new sharedViews();
        $sharedComponents->NavBar(null);
        // nav Bar

        // carousel

        // swiper des Entrées 

        // swiper des plats

        // swiper des dessert 

        // swiper des boissons 

        // Footer 
        $sharedComponents->Footer() ; 
    }
}
