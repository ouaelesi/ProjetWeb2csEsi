<?php
class seasonPage
{
    public function seasonFilter($options, $message)
    {
?>
        <div class="container-xl mx-auto filterINputs">
            <div class="d-flex justify-content-between px-4">
                <div class="h1 pb-2 artFont"><?php echo $message ?></div>
                <div class="text-warning py-3" role="button" onclick="clearfilter()">Clear filter</div>
            </div>

            <div class="d-flex gap-4 px-4 mb-3">
                <?php
                foreach ($options as $filterOption) {
                ?>

                    <div class="flex gap-2 position-relative filterBox ">
                        <p class="h6"><?php echo $filterOption['name'] ?></p>
                        <select name=<?php echo $filterOption['index'] ?> class="bluredBox selectInput postion-relative" onchange="gotoUrl(`/ProjetWeb/saisons?season=${this.value}&limit=<?php echo $_GET['limit'] ?>`)">

                            <?php foreach ($filterOption["options"] as $option) {
                            ?>
                                <option value="<?php echo $option ?>" <?php if (sizeof($_GET) > 0 and $_GET[$filterOption['index']] == $option) {
                                                                            echo "selected";
                                                                        } ?>>
                                    <?php echo $option ?>
                                </option>
                            <?php
                            } ?>

                        </select>
                        <div class="p-1 bg-light position-absolute  filterBlur mb-1"></div>
                    </div>
                    <div class="flex gap-2 position-relative filterBox ">
                        <p class="h6">definir la limite</p>
                        <input type="number" value="<?php echo $_GET['limit'] ?>" class="bluredBox selectInput postion-relative" onchange="gotoUrl(`/ProjetWeb/saisons?season=<?php echo $_GET['season'] ?>&limit=${this.value}`)" />
                        <div class="p-1 bg-light position-absolute  filterBlur"></div>
                    </div>
                <?php } ?>
            </div>
        </div>

<?php

    }

    public function displaySeasonPage()
    {
        $sharedComponents = new sharedViews();
        $recipeController = new recipeController();
        $recipes  = $recipeController->getSeasonRecipes($_GET);
        $recipePage = new recipePage();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Reacettes de la saison', "season.png");
        // navLinks 
        $sharedComponents->navLinks();
        //
        $this->seasonFilter([
            [
                "name" => "Saison",
                "index" => "season",
                "options" =>  ['tous', 'hiver', 'automne', 'printemps', 'ete'],
            ]

        ], "Choisir la saisons");

        // recipes list 
        $recipePage->recipesList($recipes);

        // footer
        $sharedComponents->Footer();
    }
}
