<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/views/userViews/sharedViews.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/categoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/recipeController.php');

class profilePage
{

    public function generalInfos($user)
    {
?>
        <div class="container-xl mb-5">
            <div class="h1 mb-5">Informations générales
                <hr />
            </div>
            <div class="row py-4">
                <form action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data" class="col-6 ">
                    <div>
                        <img src="public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                            echo $user["photo"];
                                                        } else {
                                                            echo "avatarprofile.webp";
                                                        } ?>" width="200px" class="d-block mx-auto rounded-circle" />
                    </div>
                    <div>
                        <input hidden type="text" name="userId" value='<?php echo $user['id'] ?>' />

                        <input class=" mx-auto  d-block mt-3" type="file" name="profilePic" />
                        <button class="d-block mx-auto btn btn-yellow mt-3" type="submit" name="updateProfilePic">Changer la photo</button>
                    </div>
                </form>
                <div class="col-6 ">
                    <form action="/ProjetWeb/api/apiRoute.php" method="POST" class="w-75 mx-auto d-block ">
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
                        <input hidden type="text" name="userId" value='<?php echo $user['id'] ?>' />


                        <div><button class="btn btn-red d-block ms-auto mt-3" type="submit" name="editprofile">Save edits</button></div>
                    </form>

                </div>
            </div>

        </div>

    <?php
    }

    public function statistics($userId)
    {
        $userController = new userController();
        $stats = $userController->userStats($userId)
    ?>
        <div class="container-xl my-5">
            <div class="h2 mt-5 mb-4 pt-5">
                Staistiques
                <hr />
            </div>
            <div class="bluredBox px-5 py-4 d-flex justify-content-between">
                <div class="d-flex gap-2">
                    <img src="/ProjetWeb/public/icons/fullheart.png" width="25px" />Liked posts : <?php echo $stats['likes'] ?>
                </div>
                <div class="d-flex gap-2">
                    <img src="/ProjetWeb/public/icons/star.png" width="25px" />Rated posts : <?php echo $stats['rating'] ?>
                </div>
                <div class="d-flex gap-2">
                    <img src="/ProjetWeb/public/icons/comment.png" width="25px" />Comments : <?php echo $stats['comments'] ?>
                </div>
                <div class="d-flex gap-2">
                    <img src="/ProjetWeb/public/icons/addfile.png" width="25px" />Added posts : <?php echo $stats['posts'] ?>
                </div>
            </div>
        </div>
    <?php
    }

    public function favouritePosts($userId)
    {
        $userController = new userController();
        $favouritePosts = $userController->getVafouritePosts($userId);

        $homeview = new HomePage();
    ?>
        <div class="h1 mt-5 mb-4 container pt-5">
            Mes recettes préférées
            <hr />
        </div>
        <section class="image-slider-container mb-5">
            <div class="image-slider-heading">
                <h2 class="image-slider-title">
                    Mes recettes 🤩
                </h2>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($favouritePosts as $recipe) {

                        $homeview->recipeCard($recipe, "ALL");
                    }
                    ?>
                </div>

            </div>
        </section>

    <?php
    }


    public function addedRecipes($userId)
    {
        $userController = new userController();
        $addedPosts = $userController->getUserAddedRecipes($userId);

        $homeview = new HomePage();
    ?>
        <div class="h1 mt-5 mb-4 container pt-5">
            Recette ajoutée par moi
            <hr />
        </div>
        <section class="image-slider-container mb-5">
            <div class="image-slider-heading">
                <h2 class="image-slider-title">
                    Mes recettes 🤩
                </h2>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($addedPosts as $recipe) {

                        $homeview->recipeCard($recipe, "ALL");
                    }
                    ?>
                </div>

            </div>
        </section>

<?php
    }

    public function displayProfile()
    {
        $userId = $_GET["id"];
        $userController = new userController();
        $user = $userController->getUserById($userId);
        $recipePage = new recipePage();
        $sharedComponents = new sharedViews();
        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader("Profile Page", "footerBg.png");
        // navLinks 
        $sharedComponents->navLinks();
        // general informations
        $this->generalInfos($user);
        // user stats
        $this->statistics($user["id"]);
        // favourite posts 
        $this->favouritePosts($user['id']);

        // add recipe section 
        $recipePage->addRecipeSection();
        // added recipes 
        $this->addedRecipes($user['id']);

        $sharedComponents->Footer();
    }
}
