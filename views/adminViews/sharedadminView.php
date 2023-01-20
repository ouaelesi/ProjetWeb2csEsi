<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/router/nestedRoutes.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/menuController.php");

class sharedadminView
{
    public function sideBar()
    {
        $menuController = new menuController();
        $logo = $menuController->getLogo("Home");
        $links = [
            ["name" => "Statistiques", 'link' => 'statistiques'],
            ["name" => "Gestion des utilisateurs", 'link' => 'users'],
            ["name" => "Gestion des Recettes", 'link' => 'recettes'],
            ["name" => "Gestions des News", 'link' => 'news'],
            ["name" => "Gestions des nutrition", 'link' => 'ingredients'],
            ["name" => "Les Notifications", 'link' => 'notifications'],
            ["name" => "Gestions des paramaitres", 'link' => 'paramaitres']
        ]

?>
        <div class="sideBar w-100 position-relative ">
            <img src="/ProjetWeb/public/images/footerBg.png" width="100%" class="position-absolute bottom-0" />
            <img src="/ProjetWeb/public/images/footerBg.png" width="100%" class="position-absolute top-0" height="20px" />
            <div class="w-100 bluredBox h-100  rounded-0 border-0">
                <div class="py-4">
                    <img src="/ProjetWeb/public/logos/<?php echo $logo['logo'] ?>" width="50%" class="d-block mx-auto" />
                </div>

                <?php foreach ($links as $link) {
                ?>
                    <div class="py-3 my-1 text-center ">
                        <a href="/ProjetWeb/admin/<?php echo $link['link'] ?>" class="hover-text-warning text-decoration-none text-light "><?php echo $link['name'] ?></a>
                    </div>
                <?php
                } ?>

            </div>
            <img src="/ProjetWeb/public/images/footerBg.png" width="100%" class="position-absolute bottom-0" />

        </div>

    <?php
    }

    public function navHeader()
    {
        $userController = new userController();
        $user = $userController->getUserById($_COOKIE['logedIn_user'])
    ?><div class="position-relative ">
            <div class="w-100 bluredBox  rounded-4 py-3  sticky-top postion-sticky px-3 rounded-4 d-flex justify-content-between">
                <div class="h5 pt-2">
                    Admin Dashboard
                </div>
                <div class="d-flex gap-2 pt-1">
                    <div onclick="gotoUrl('/ProjetWeb/admin/notifications')" role="button" class="bluredBox profileBox p-1 rounded-circle"> <img src="/ProjetWeb/public/icons/notification.png" width="28px" height="26px" class=" d-block my-auto rounded-circle " /></div>

                    <div onclick="switchMode()" role="button" class="bluredBox profileBox p-1 rounded-circle" id="themeSwitch"> <img src="/ProjetWeb/public/icons/sun.png" width="30px" height="30px" class=" d-block my-auto rounded-circle" /></div>
                    <div role="button" class="bluredBox profileBox p-1 rounded-circle"> <img src="/ProjetWeb/public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                                                                                                        echo $user["photo"];
                                                                                                                                    } else {
                                                                                                                                        echo "avatarprofile.webp";
                                                                                                                                    } ?>" width="31px" height="31px" class="  rounded-circle" onclick="gotoUrl('/ProjetWeb/profile?id=<?php echo $_COOKIE['logedIn_user'] ?>')" role="button" /></div>
                    <div>
                        <div onclick="logout()" role="button" class="bluredBox profileBox p-1 rounded-circle"> <img src="/ProjetWeb/public/icons/logout.png" width="28px" height="28px" class=" d-block my-auto rounded-circle" /></div>
                    </div>
                </div>
            </div>
            <img src="/ProjetWeb/public/images/footerBg.png" width="100%" height="70px" class=" rounded-circle position-absolute bottom-0" />
        </div>

    <?php
    }

    public function pageHeader($title)
    {
    ?>
        <div class="artFont h1">
            <?php echo $title ?>
        </div>
    <?php
    }

    public function adminDashboardTempale()
    {

        $nestedRoutes = new nestedRoutes();
    ?>
        <div class="d-flex">
            <div class="col-2 ">
                <?php $this->sideBar(); ?>
            </div>
            <div class="col-10 adminpages">
                <div class="p-3 px-5 position-sticky sticky-top "><?php $this->navHeader() ?></div>
                <div class="px-5 py-4"><?php $nestedRoutes->displayNestedRoutes() ?></div>
            </div>
        </div>
<?php
    }
}
