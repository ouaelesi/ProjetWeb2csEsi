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
            ["name" => "Gestions des nutrition", 'link' => 'ingredients']
        ]

?>
        <div class="sideBar w-100 position-relative ">
            <img src="/ProjetWeb/public/images/footerBg.png" width="100%" class="position-absolute bottom-0" />

            <div class="w-100 bluredBox h-100  rounded-0 border-0 ">
                <div class="py-4">
                    <img src="/ProjetWeb/public/logos/<?php echo $logo['logo'] ?>" width="50%" class="d-block mx-auto" />
                </div>

                <?php foreach ($links as $link) {
                ?>
                    <div class="py-4 text-center">
                        <a href="/ProjetWeb/admin/<?php echo $link['link'] ?>" class="text-light text-decoration-none"><?php echo $link['name'] ?></a>
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
    ?>
        <div class="w-100 bluredBox  rounded-0 py-3 border-0 sticky-top postion-sticky">Ouael</div>
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
                <div><?php $this->navHeader() ?></div>
                <div class="px-5 py-4"><?php $nestedRoutes->displayNestedRoutes() ?></div>
            </div>
        </div>
<?php
    }
}
