<?php

class eventsPage
{
    public function eventsFilter($options , $message){
        ?>
            <div class="container mx-auto filterINputs">
                <div class="d-flex justify-content-between px-4">
                    <div class="h1 pb-2 artFont"><?php echo $message ?></div>
                    <div class="text-warning py-3" onclick="clearfilter()">Clear filter</div>
                </div>
        
                <div class="d-flex justify-content-between px-4 mb-3">
                    <?php
                    foreach ($options as $filterOption) {
                    ?>
        
                        <div class="flex gap-2 position-relative filterBox ">
                            <p class="h6"><?php echo $filterOption['name'] ?></p>
                            <select name=<?php echo $filterOption['index'] ?> class="selectInput postion-relative" onchange="gotoUrl(`/ProjetWeb/fetes?fete=${this.value}`)">
                                <option value="all">Tous</option>
                                <?php foreach ($filterOption["options"] as $option) {
                                ?>
                                    <option value="<?php echo $option['id'] ?>" <?php if (sizeof($_GET) > 0 and $_GET[$filterOption['index']] == $option['id']) {
                                                                                    echo "selected";
                                                                                } ?>>
                                        <?php echo $option['name'] ?>
                                    </option>
                                <?php
                                } ?>
        
                            </select>
                            <div class="p-1 bg-light position-absolute  filterBlur"></div>
                        </div>
                    <?php } ?>
                    <!-- <div class="flex gap-2 position-relative filterBox  pt-4">
                                <button class="btn btn-yellow " onclick="upplyFilter()">Filtrer</button>
                            </div> -->
                </div>
            </div>
        
        <?php
        
                }
        
    public function recipesList()
    {
    }
    public function displayEventsPage()
    {
        $eventsController = new eventsController();
        $events = $eventsController->getEvents();
        $sharedComponents = new sharedViews();
        $recipeController = new recipeController();
        $recipes  = $recipeController->getEventsRecipes($_GET);
        $recipePage = new recipePage();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Les Fetes' , "fetes.jpg");
        // navLinks 
        $sharedComponents->navLinks();
        // filtring section 

        $this->eventsFilter([
            [
                "name" => "fete",
                "index" => "fete",
                "options" =>  $events,
            ]

        ], "Choisir la fete");

        // recipes list 
        $recipePage->recipesList($recipes);

        // footer
        $sharedComponents->Footer();
    }
}
