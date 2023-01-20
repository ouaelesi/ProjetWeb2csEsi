<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/recipePage.php');

class healthyPage
{
    public function filterInputs($options, $message)
    {
?>
        <div class="container-xl mx-auto filterINputs ">
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
                        <select name=<?php echo $filterOption['index'] ?> class="selectInput bluredBox postion-relative" onchange="gotoUrl(`/ProjetWeb/healthy?seuil=${this.value}`)">
                            <option value="null">Tous les recettes</option>
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
    public function filterSection()
    {
    ?>
        <div class="container">
            <div class="h1 artFont d-flex gap-3 w-50 mx-auto mb-5">
                definir vos critére d'une recette healthy <img src="public/icons/healthy.png" width='40px' height="40px" />
            </div>
            <div>
                <?php
                $this->filterInputs([
                    [
                        "name" => "Seuil des ingredients non healthy",
                        "index" => "seuil",
                        "options" =>  [
                            ["id" => "0.2", "name" => "0.2 %"],
                            ["id" => "0.4", "name" => "0.4 %"],
                            ["id" => "0.6", "name" => "0.6 %"],
                            ["id" => "0.7", "name" => "0.7 %"],
                            ["id" => "0.8", "name" => "0.8 %"],
                        ]
                    ]

                ], "Filtrer les recettes"); ?>
            </div>
        </div>

<?php

    }
    public function displayHealthyPage()
    {
        $sharedComponents = new sharedViews();
        $recipePage = new recipePage();
        $recipeController = new recipeController();
        $avg = 1;
        if (sizeof($_GET) > 0 and $_GET['seuil'] != '' and $_GET['seuil'] != 'null') {
            $avg = $_GET['seuil'];
        }
        $recipes  = $recipeController->getHealthyRecipes($avg);

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Les recette healthy', "healthy.png");
        // navLinks 
        $sharedComponents->navLinks();
        // search input 
        $this->filterSection();
        // filters 
        // $recipePage->filterSection();

        // recipes
        $recipePage->recipesList($recipes);

        // footer
        $sharedComponents->Footer();
    }
}
