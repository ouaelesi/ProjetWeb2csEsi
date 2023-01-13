<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/profilePage.php');

class singleUserPage
{
    public function generalInfos($user)
    {
?>
        <div class="container mb-5">
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
                    <button id="validateAccountBtn" class="btn btn-yellow mx-2" onclick="validateAccount(<?php echo $user['id'] ?>)">Valider le compte</button>
                    <button id="validateAccountBtn" class="btn btn-red" onclick="rejectAccount(<?php echo $user['id'] ?>)">rejecter le compte</button>
                <?php
                } ?>
            </div>
        </div>
    <?php
    }

    public function addedRecipes($recipes)
    {
    ?>
        <div class="h3 my-5 pt-5">Recettes Ajoutées
            <hr />
        </div>
        <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableHeader" role="button">
            <div class="col-5"> Recette</div>
            <div class="col-3">date</div>
            <div class="col-2">status</div>
            <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
        </div>
        <?php
        foreach ($recipes as $recipe) {
        ?>
            <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $recipe['id'] ?>')">
                <div class="col-5 "><?php echo $recipe['title'] ?></div>
                <div class="col-3">0-0-0-0</div>
                <div class="col-2"><?php echo $recipe['status'] ?></div>
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
