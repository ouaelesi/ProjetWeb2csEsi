<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');

class AdminRecipeViews
{
    public function addRecipeForm()
    {
?>
        <h2> form des recettes</h2>
        <form method="POST" action="/ProjetWeb/api/apiRoute.php" enctype="multipart/form-data">
            <label>Titre</label>
            <input name="title" placeholder="titre du recette" type="text" required />

            <label>Déscription</label>
            <input name="description" placeholder="description du recette" type="text" required />

            <label>Type</label>
            <input name="type" placeholder="description du recette" type="text" required />

            <label>Category</label>
            <select name="category">
                <?php
                $categoryController = new categoryController();
                $categories = $categoryController->getCategories();
                foreach ($categories as $category) {
                ?>
                    <option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
                <?php
                }
                ?>
            </select>

            <label>Image de couverture</label>
            <input name="coverImage" type="file" required />

            <label>Image du carte </label>
            <input name="cardImage" type="file" required />


            <label>Video </label>
            <input name="video" placeholder="video" type="text" required />

            <label>Event </label>

            <select name="event">
                <?php
                $eventsController = new eventsController();
                $events = $eventsController->getEvents();
                foreach ($events as $event) {
                ?>
                    <option value="<?php echo $event["id"] ?>"><?php echo $event["name"] ?></option>
                <?php
                }
                ?>
            </select>

            <label>video</label>
            <input name="video" placeholder="video" type="text" required />

            <label>temps de préparation</label>
            <input name="preparationTime" placeholder="video" type="number" required />

            <label>temps de cuisson</label>
            <input name="cookTime" placeholder="video" type="number" required />

            <label>temps de rest</label>
            <input name="restTime" placeholder="video" type="number" required />

            <button type="submit" name="addRecipe">Ajouter La recette </button>
        </form>

        <h2>valider recette</h2>
        <a href="/ProjetWeb/api/apiRoute.php?recipe_id=17&&validateRecipe=valid">
            <button name="validateRecipe"> validate recetter</button>
        </a>

<?php
    }

    public function recipeList()
    {

        $recipeController = new recipecontroller();
        $recipeController->getRecipes(1);
    }

    public function updateRecipeForm()
    {

        $recipeController = new recipeController() ; 
        $recetteData = $recipeController->getRecipe(6); 
?>
        <h2> modification des recettes</h2>
        <form method="POST" action="/ProjetWeb/api/apiRoute.php">
            <label>Titre</label>
            <input name="title" placeholder="titre du recette" type="text" required  value="<?php echo $recetteData['title'] ?>"/>

            <label>Déscription</label>
            <input name="description" placeholder="description du recette" type="text" required value="<?php echo $recetteData['description'] ?>" />

            <label>Type</label>
            <input name="type" placeholder="description du recette" type="text" required value="<?php echo $recetteData['type'] ?>"/>

            <label>Category</label>
            <select name="category" value="<?php echo $recetteData['categoryID'] ?>">
                <?php
                $categoryController = new categoryController();
                $categories = $categoryController->getCategories();
                foreach ($categories as $category) {
                ?>
                    <option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
                <?php
                }
                ?>
            </select>

            <label>Image de couverture</label>
            <input name="coverImage" type="file" required />

            <label>Image du carte </label>
            <input name="cardImage" type="file" required />


            <label>Video </label>
            <input name="video" placeholder="video" type="text" required />

            <label>Event </label>

            <select name="event">
                <?php
                $eventsController = new eventsController();
                $events = $eventsController->getEvents();
                foreach ($events as $event) {
                ?>
                    <option value="<?php echo $event["id"] ?>"><?php echo $event["name"] ?></option>
                <?php
                }
                ?>
            </select>

            <label>video</label>
            <input name="video" placeholder="video" type="text" required />

            <label>temps de préparation</label>
            <input name="preparationTime" placeholder="video" type="number" required />

            <label>temps de cuisson</label>
            <input name="cookTime" placeholder="video" type="number" required />

            <label>temps de rest</label>
            <input name="restTime" placeholder="video" type="number" required  />

            <button type="submit" name="addRecipe">Ajouter La recette </button>
        </form>


<?php
    }

    
    public function displayAdminRecipePage()
    {
        $this->addRecipeForm();
        $this->recipeList();
        $this->updateRecipeForm() ; 
    }
}
