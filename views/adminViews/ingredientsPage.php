<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedAdminView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/ingredientController.php");

class ingredientsPage
{

    public function addIngredient()
    {
        $ingredientController = new ingredientController();
        $informations = $ingredientController->getInformations();
?>
        <div>
            <div class="bluredBox px-3 pt-4 pb-2  mt-5   mx-auto rounded-3 position-relative">
                <div class="artFont text-center h1">
                    Ajouter un ingredient
                </div>
                <form class="row" method="POST" action="/ProjetWeb/api/apiRoute.php">

                    <div class="my-2 col-6">
                        <label class="mb-1">Nom</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="name" />
                    </div>
                    <div class="my-2 col-6">
                        <label class="mb-1">saison</label>
                        <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="season">
                            <option value="tous">Tous les saison</option>
                            <option value="hiver">hiver</option>
                            <option value="automne">automne</option>
                            <option value="printemps">printemps</option>
                            <option value="ete">été</option>
                        </select>
                    </div>
                    <div class="my-2 col-6">
                        <label class="mb-1">healthy</label>
                        <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="healthy">
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                    <div class="my-2 col-6">
                        <label class="mb-1">Calories</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="number" required placeholder="calories" name="calories" />
                    </div>

                    <?php foreach ($informations as $info) {
                    ?>
                        <div class="my-2 col-6">
                            <label class="mb-1"><?php echo $info['name'] ?></label>
                            <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="number" required placeholder="contité de <?php echo $info['name'] ?>" name="<?php echo $info['name'] ?>" />
                        </div>
                    <?php
                    } ?>

                    <div class="row my-2  px-0 mx-0">
                        <div class="col-12"><button class="btn btn-red d-block ms-auto px-3" type="submit" name="addIngredient">Ajouter ingredient</button></div>
                    </div>
                </form>

            </div>
        </div>
<?php
    }
    public function displayIngredientsPage()
    {
        // imports 
        $sharedViews = new sharedadminView();

        // page title
        $sharedViews->pageHeader('Gestion des nutritions');

        // add ingredient 

        $this->addIngredient();
    }
}
