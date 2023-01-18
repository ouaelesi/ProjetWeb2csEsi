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
            <div class="bluredBox px-3 pt-4 pb-2  my-5   mx-auto rounded-3 position-relative">
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
    public function ingredientsList($ingredients)
    {
    ?>
        <table data-search="true" data-toggle="table" class="table-style " id="table" data-show-pagination-switch="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-show-footer="false">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">
                    <th data-sortable="true" class="col-3"> ingredient</th>
                    <th data-sortable="true" class="col-2">Healthy</th>
                    <th data-sortable="true" class="col-3">Saison</th>
                    <th data-sortable="true" class="col-2">Calories</th>
                    <th data-sortable="true" class="col-2 text-center">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ingredients as $ingredient) {
                ?>
                    <tr class="d-flex bluredBox  rounded-1 justify-content-between my-2 TableRow" role="button">
                        <th class="col-3 ">
                            <input value="<?php echo $ingredient['name'] ?>" name="name" class="bg-transparent border-0" id="ingredientName" />
                        </th>
                        <th class="col-2">
                            <select class="bg-transparent border-0 text-light" name="healthy" id="isHealthy">
                                <option value="1" <?php if ($ingredient['healthy'] == 1) echo 'selected' ?>>Yes</option>
                                <option value="0" <?php if ($ingredient['healthy'] == 0) echo 'selected' ?>>Non</option>
                            </select>
                        </th>
                        <th class="col-3">
                            <select class="bg-transparent border-0 text-light" name="season" id="ingredientSeason">
                                <option value="tous" <?php if ($ingredient['season'] == 'tous') echo 'selected' ?>>tous les saison</option>
                                <option value="hiver" <?php if ($ingredient['season'] == 'hiver') echo 'selected' ?>>Hiver</option>
                                <option value="automne" <?php if ($ingredient['season'] == 'automne') echo 'selected' ?>>automne</option>
                                <option value="printemps" <?php if ($ingredient['season'] == 'printemps') echo 'selected' ?>>printemps</option>
                                <option value="ete" <?php if ($ingredient['season'] == 'ete') echo 'selected' ?>>été</option>
                            </select>
                        </th>
                        <th class="col-2"><input value="<?php echo $ingredient['calories'] ?>" name="calories" class="bg-transparent border-0" id="calories" /> </th>
                        <th class="col-2 "><button class="btn btn-yellow mx-2" onclick="editIngredient(<?php echo $ingredient['id'] ?>)">Edit</button> <button class="btn btn-red" onclick="deleteIngredient(<?php echo $ingredient['id'] ?>)">del</button></th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    }
    public function displayIngredientsPage()
    {

        $ingredientController = new ingredientController();
        $ingredients = $ingredientController->getIngredients();
        // imports 
        $sharedViews = new sharedadminView();

        // page title
        $sharedViews->pageHeader('Gestion des nutritions');

        // add ingredient 
        $this->addIngredient();

        // ingredients list
        $this->ingredientsList($ingredients);
    }
}
