<?php 
class seasonPage{
    public function displaySeasonPage(){
        $sharedComponents = new sharedViews();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Contactez Nous', "contact.jpg");
        // navLinks 
        $sharedComponents->navLinks();
    }
}