<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/eventsController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
class addRecipePage
{
    public function addRecipeForm()
    {
?>
        <div class="container w-75">
            <div class="d-flex justify-content-center pb-5">
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle activeStep">
                        1
                    </div>
                    <p class="text-center mt-2">Ajouter</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        2
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        3
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
                <div class="stepLine"></div>
                <div>
                    <div class="rounded-circle text-center bluredBox stepCircle">
                        4
                    </div>
                    <p class="text-center mt-2">Step details</p>
                </div>
            </div>
            <div enctype="multipart/form-data" class="bluredBox p-4 rounded-3 d-flex mb-5 flex-wrap gap-4 justify-content-between">
                <div class="col-12 artFont text-warning h1">1. Les informations générales de la recette
                    <hr />
                </div>
                <div class="my-2 col-5 ">
                    <label>Titre</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="title" placeholder="titre du recette" type="text" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Déscription</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="description" placeholder="description du recette" type="text" required />
                </div>

                <div class="my-2 col-5  ">
                    <label>Category</label>
                    <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="category">
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
                </div>
                <div class="my-2 col-5  ">
                    <label>Image de couverture</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="coverImage" type="file" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Image du carte </label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="cardImage" type="file" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>Event </label>

                    <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="event">
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
                </div>
                <div class="my-2 col-5  ">
                    <label>video</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="video" placeholder="video" type="text" required />
                </div>
                <div class="my-2 col-5">
                    <label>temps de préparation</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="preparationTime" placeholder="video" type="number" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>temps de cuisson</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="cookTime" placeholder="video" type="number" required />
                </div>
                <div class="my-2 col-5  ">
                    <label>temps de rest</label>
                    <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="restTime" placeholder="video" type="number" required />
                </div>
                <div class="col-12">
                    <button name="addRecipe" class="btn btn-red ms-auto d-block" onclick='addRecipeByUser()'>Suivant </button>
                </div>
            </div>
            <!-- <form method="post" action="/ProjetWeb/api/apiRoute.php"  class="bluredBox p-4 rounded-3 d-flex mb-5 flex-wrap gap-4 justify-content-between">
               
            </form> -->

        </div>

<?php
    }
    public function displayRecipePage()
    {
        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Ajouter une recette");
        // navLinks 
        $sharedComponents->navLinks();
        // add recipe form
        $this->addRecipeForm();

        // footer
        $sharedComponents->Footer();
    }
}