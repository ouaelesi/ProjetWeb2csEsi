<?php

class paramsPage
{

    public function manageNavBar()
    {
        // imports 
        $sharedViews = new sharedadminView();
        // page title
        $sharedViews->pageHeader('Manage Menu');
        $menu = new menuModel();
        $homeMenu = $menu->getMenu("Home");
        foreach ($homeMenu as $data) {
?>
            <div>

                <div class="  position-relative pt-4 pb-2">
                    <p class="pb-4 text-center h3">Logo </p>
                    <img class="d-block mx-auto" src="/ProjetWeb/public/logos/<?php echo $data["logo"] ?>" width="200px" alt="" />
                    <form action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data">
                        <input hidden type="text" name="menuID" value='<?php echo $data['id'] ?>' />

                        <input class=" mx-auto  d-block mt-3" type="file" name="logoPic" />
                        <button class="d-block mx-auto btn btn-yellow mt-3" type="submit" name="changeLogo">Changer le logo</button>
                    </form>
                </div>
                <p class="py-4 text-center h3 mt-5">Les liens </p>
                <div class="d-flex">
                    <ul class=" col-6 gap-4  footer-nav-links mx-auto  mb-5">
                        <?php
                        foreach ($data['links'] as $link) {
                        ?>
                            <input value="<?php echo $link['name'] ?>" class="bluredBox px-3 py-2 m-2">
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="col-6">
                        <p class=" text-center h5">Ajouter un liens </p>

                        <form class="w-75 mx-auto bluredBox px-3 py-3" action="/ProjetWeb/api/apiRoute.php" method="POST">

                            <label>Nom du lien</label>
                            <input class="bluredBox d-block w-100 mx-auto py-2 px-3 my-2" placeholder="name" name="name" />
                            <label>Url du lien</label>
                            <input class="bluredBox d-block w-100 mx-auto py-2 px-3 my-2" placeholder="h" name="href" />
                            <input hidden type="text" name="menuID" value='<?php echo $data['id'] ?>' />

                            <button class="btn btn-yellow mt-3 px-3 ms-auto d-block" name="addlink">Ajouter</button>
                        </form>
                    </div>
                </div>


                <div>
                    <p class="py-4 text-center h3">Social Media </p>
                    <ul class="d-flex gap-4 justify-content-around footer-socialMedia mx-auto mb-5 ">
                        <?php
                        foreach ($data['socialmedia'] as $link) {
                        ?>
                            <li><a href="/ProjetWeb<?php echo $link['href'] ?>" class="text-decoration-none text-light"><img class="d-block mx-3" src="/ProjetWeb/public/images/socialMedia/<?php echo $link["icon"] ?>" width="40px" alt="" /></a></li>
                        <?php
                        }
                        ?>
                    </ul>

                </div>
                <hr />
            </div>
        <?php
        }
    }


    public function manageSwiper()
    {
        // imports 
        $sharedViews = new sharedadminView();
        $sharedViews->pageHeader('Manage Carousele');
        $homeSection  = new HomePage();
        ?>
        <div class="d-flex mt-5">
            <div class="col-6 ">
                <p class="pb-4 text-center h5">Le preview du carouselle </p>
                <?php $homeSection->swiper("admin") ?>
            </div>
            <div class="col-6">
                <p class="pb-4 text-center h5">Ajouter un Slide </p>
                <form action="/ProjetWeb/api/apiRoute.php" method="POST" enctype="multipart/form-data" class="bluredBox px-3 py-3 w-75 mx-auto">
                    <label>Titre</label>
                    <input class="bluredBox d-block w-100 mx-auto py-2 px-3 my-2" placeholder="titre" name="title" />
                    <label>Discription</label>
                    <input class="bluredBox d-block w-100 mx-auto py-2 px-3 my-2" placeholder="description" name="description" />
                    <label>Backgroud</label>
                    <input class="bluredBox d-block w-100 mx-auto py-1 px-1 my-2" type="file" placeholder="h" name="photo" />
                    <label>Type</label>
                    <select class="bluredBox d-block w-100 mx-auto py-2 px-3 my-2" name="type">
                        <option value="recipe">Recette</option>
                        <option value="news">News</option>
                    </select>

                    <button class="btn btn-yellow mt-3 px-3 ms-auto d-block" name="addSlide">Ajouter</button>

                    <input hidden type="text" name="swiperID" value='1' />
                </form>
            </div>

        </div>
    <?php
    }



    public function styleThemes()
    {
        // imports 
        $sharedViews = new sharedadminView();
        $sharedViews->pageHeader('WebSite Themes');
    ?>
        <div class="d-flex justify-content-center gap-5 py-5">
            <div onclick="setMode('darkMode')" role="button" class="d-flex gap-2 bluredBox px-4 py-3">
                <span class="pt-1">Dark Mode</span> <img src="/projetWeb/public/icons/moon.png" widht="30px" height="30px" />
            </div>
            <div onclick="setMode('lightMode')" role="button" class="d-flex gap-2 bluredBox px-4 py-3">
                <span class="pt-1">Light Mode</span> <img src="/projetWeb/public/icons/sun.png" widht="30px" height="30px" />
            </div>
        </div>
        <hr />
<?php
    }


    public function displyParamsPage()
    {
        $this->manageNavBar();
        $this->styleThemes();
        $this->manageSwiper();
    }
}
