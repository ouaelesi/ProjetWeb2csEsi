<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/profilePage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
class singleUserPage
{
    public function generalInfos($user)
    {
?>
        <div class="container-xl mb-5">
            <div class="h3 my-5">Informations générales
                <hr />
            </div>

            <div class="row py-4 gap-4">
                <div class="col-3 ">
                    <div class="pt-4">
                        <img src="/ProjetWeb/public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                                        echo $user["photo"];
                                                                    } else {
                                                                        echo "avatarprofile.webp";
                                                                    } ?>" width="200px" class="d-block  rounded-circle" />
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="w-100 mx-auto d-block ">
                        <label>Nom</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="lastName" value='<?php echo $user['lastName'] ?>' />

                        </div> <label>Prénom</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="firstName" value='<?php echo $user['firstName'] ?>' />
                        </div>
                        <label>email</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="email" value='<?php echo $user['email'] ?>' />

                        </div>
                    </div>

                </div>
                <div class="col-4 ">
                    <div class="w-100 mx-auto d-block ">
                        <label>status</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="lastName" value='<?php echo $user['status'] ?>' />

                        </div> <label>Prénom</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="firstName" value='<?php echo $user['sex'] ?>' />
                        </div>
                        <label>email</label>
                        <div class="d-flex gap-2">
                            <input class="my-2 bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" name="email" value='<?php echo $user['dateOfBirth'] ?>' />
                        </div>
                    </div>

                </div>
            </div>

        </div>

    <?php
    }



    public function pageHeader($user)
    {
        $sharedViews = new sharedadminView();
    ?>
        <div class="d-flex justify-content-between">
            <div>
                <?php
                $sharedViews->pageHeader('Profile de l utilisateur: ' . $user['firstName'] . ' ' . $user['lastName']);
                ?>
            </div>
            <div>
                <?php if ($user['status'] == "pending") {
                ?>
                    <button id="validateAccountBtn" class="btn btn-success mx-2" onclick="validateAccount(<?php echo $user['id'] ?>)">Valider le compte</button>
                    <button id="validateAccountBtn" class="btn btn-danger" onclick="rejectAccount(<?php echo $user['id'] ?>)">Blocker le compte</button>
                <?php
                } ?>
                <?php if ($user['status'] == "rejected") {
                ?>
                    <span class="text-danger me-5">ce compte est bloqué</span> <button id="validateAccountBtn" class="btn btn-success mx-2" onclick="validateAccount(<?php echo $user['id'] ?>)">Valider le compte</button>
                <?php
                } ?>
                <?php if ($user['status'] == "valid") {
                ?>
                    <span class="text-success me-5">ce compte est valide</span> <button id="validateAccountBtn" class="btn btn-red" onclick="rejectAccount(<?php echo $user['id'] ?>)">blocker le compte</button>

                <?php
                } ?>

            </div>
        </div>
    <?php
    }

    public function addedRecipes($recipes)
    {
        $categoryController = new categoryController();
    ?>
        <div class="h3 my-5 pt-5">Recettes Ajoutées
            <hr />
        </div>
        <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 mt-5 TableHeader" role="button">
            <div class="col-3">Titre</div>
            <div class="col-1 text-center">Categorie</div>
            <div class="col-1 text-center">Rating</div>
            <div class="col-1 text-center">rest Time</div>
            <div class="col-1 text-center">cook time</div>
            <div class="col-1 text-center">preparation</div>
            <div class="col-2 text-center">Status</div>
            <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
        </div>
        <?php
        foreach ($recipes as $recipe) {
            $category = $categoryController->getCategoryById($recipe['categoryID']);
        ?>
            <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $recipe['id'] ?>')">
                <div class="col-3 "><?php echo $recipe['title'] ?></div>
                <div class="col-1 text-center bluredBox pt-1"><?php echo $category['name'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['note'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['restTime'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['cookTime'] ?></div>
                <div class="col-1 text-center"><?php echo $recipe['preparationTime'] ?></div>
                <div class="col-2">
                    <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($recipe['status'] == 'valid') echo 'bg-success';
                                                                                    else if ($recipe['status'] == 'rejected') echo 'bg-danger';
                                                                                    else echo 'bg-warning' ?>"><?php echo $recipe['status'] ?></div>
                </div>
                <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
            </div>
        <?php
        }
        ?>
<?php
    }

    public function displayProfilePage()
    {
        $userId = $_GET["id"];
        $userController = new userController();
        $user = $userController->getUserById($userId);
        $addedPosts = $userController->getUserAddedRecipes($user['id']);
        $sharedViews = new sharedadminView();
        $profilePage = new profilePage();
        // page title
        $this->pageHeader($user);
        // genreal infos 
        $this->generalInfos($user);
        // stats 
        $profilePage->statistics($user['id']);
        // created recipes 
        $this->addedRecipes($addedPosts);
    }
}
