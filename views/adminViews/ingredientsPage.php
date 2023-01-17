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
    public function ingredientsList($ingredients)
    {
    ?>
      <table data-search="true" data-toggle="table" class="table-style">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">
                    <th data-sortable="true" class="col-4">nom</th>
                    <th data-sortable="true" class="col-2">Event</th>
                    <th data-sortable="true" class="col-3">Status</th>
                    <th data-sortable="true" class="col-3">management</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($news as $new) {
                    $eventController = new eventsController();
                    $event = $eventController->getEventByID($new['event']);

                ?>
                    <tr class="d-flex bluredBox  rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $new[0] ?>')">
                        <td class="col-4 text-light "><a href="/ProjetWeb/article?id=<?php echo $new[0] ?>" class="text-light"><?php echo $new['title'] ?></a></td>
                        <td class="col-2 text-center text-light "><?php echo $event['name'] ?></td>
                        <td class="col-3 text-light ">
                            <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($new['status'] == 'valid') echo 'bg-success';
                                                                                            else if ($new['status'] == 'rejected') echo 'bg-danger';
                                                                                            else echo 'bg-warning' ?>"><?php echo $new['status'] ?></div>
                        </td>
                        <td class=" text-light col-3 d-flex justify-content-center gap-3 "><button class="btn btn-yellow">Edit</button> <button class="btn btn-red">Supprimer</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div>
            <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 mt-5 TableHeader" role="button">
                <th  class="col-3"> ingredient</th>
                <th class="col-2">Healthy</th>
                <th class="col-3">Saison</th>
                <th class="col-2">Calories</th>
                <th class="col-2 text-center">Manage</th>
            </div>
            <?php
            foreach ($ingredients as $ingredient) {
            ?>
                <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableRow" role="button">
                    <div class="col-3 ">
                        <input value="<?php echo $ingredient['name'] ?>" name="name" class="bg-transparent border-0" id="ingredientName" />
                    </div>
                    <div class="col-2">
                        <select class="bg-transparent border-0 text-light" name="healthy" id="isHealthy">
                            <option value="1" <?php if ($ingredient['healthy'] == 1) echo 'selected' ?>>Yes</option>
                            <option value="0" <?php if ($ingredient['healthy'] == 0) echo 'selected' ?>>Non</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="bg-transparent border-0 text-light" name="season" id="ingredientSeason">
                            <option value="tous" <?php if ($ingredient['season'] == 'tous') echo 'selected' ?>>tous les saison</option>
                            <option value="hiver" <?php if ($ingredient['season'] == 'hiver') echo 'selected' ?>>Hiver</option>
                            <option value="automne" <?php if ($ingredient['season'] == 'automne') echo 'selected' ?>>automne</option>
                            <option value="printemps" <?php if ($ingredient['season'] == 'printemps') echo 'selected' ?>>printemps</option>
                            <option value="ete" <?php if ($ingredient['season'] == 'ete') echo 'selected' ?>>été</option>
                        </select>
                    </div>
                    <div class="col-2"><input value="<?php echo $ingredient['calories'] ?>" name="calories" class="bg-transparent border-0" id="calories" /> </div>
                    <div class="col-2 "><button class="btn btn-yellow mx-2" onclick="editIngredient(<?php echo $ingredient['id'] ?>)">Edit</button> <button class="btn btn-red" onclick="deleteIngredient(<?php echo $ingredient['id'] ?>)">Supprimer</button></div>
                </div>
            <?php
            }
            ?>

        </div>
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
