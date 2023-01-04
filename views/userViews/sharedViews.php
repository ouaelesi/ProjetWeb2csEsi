<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/models/databaseModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjetWeb/controllers/menuController.php');
// cette class contient les methode qui affiche les composants partagé entre plusiers page 
class SharedViews
{
    // display navBar
    public function NavBar($linksData)
    {
        ?>
        <div class="NavContainer">

            <?php
            $menu = new menuController();
            $homeMenu = $menu->getMenu("Home");
            foreach ($homeMenu as $data) {
                // Logo 
                ?>
                <div>
                    <div class="py-2">
                        <ul class="d-flex gap-4 justify-content-around footer-socialMedia mx-auto pt-1">
                            <?php
                            foreach ($data['socialmedia'] as $link) {
                                ?>
                                <li><img class="d-block " src="public/images/socialMedia/<?php echo $link["icon"] ?>" width="20px"
                                        alt="" /></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between">
                        <img src="public/logos/<?php echo $data["logo"] ?>" width="150px" alt="" />
                        <ul class="d-flex ">
                            <?php
                            foreach ($data['links'] as $link) {
                                if ($link["type"] == "button") {
                                    ?>
                                    <button class="btn btn-yellow my-auto"><?php echo $link['name'] ?></button>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>



                </div>

            </div>
            <?php
            }
    }

    public function navLinks()
    {
        $menu = new menuModel();
        $homeMenu = $menu->getMenu("Home");
        foreach ($homeMenu as $data) {
            ?>
            <ul class="d-flex gap-4 justify-content-around nav-links mx-auto  mb-5">
                <?php
                foreach ($data['links'] as $link) {
                    ?>
                    <li><a href="/ProjetWeb<?php echo $link["href"] ?>" class="text-decoration-none text-light">
                            <?php echo $link['name'] ?>
                        </a></li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
    }
    // display Footer 
    public function Footer()
    {

        $menu = new menuModel();
        $homeMenu = $menu->getMenu("Home");
        foreach ($homeMenu as $data) {
            ?>
            <div class="footer">
                <div class="footerBg"></div>
                <div class="position-relative pt-4 pb-2"> <img class="d-block mx-auto"
                        src="public/logos/<?php echo $data["logo"] ?>" width="150px" alt="" />
                    <ul class="d-flex gap-4 justify-content-around footer-nav-links mx-auto mt-5 mb-5">
                        <?php
                        foreach ($data['links'] as $link) {
                            ?>
                            <li><?php echo $link['name'] ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="d-flex gap-4 justify-content-around footer-socialMedia mx-auto mb-5 ">
                        <?php
                        foreach ($data['socialmedia'] as $link) {
                            ?>
                            <li><img class="d-block mx-3" src="public/images/socialMedia/<?php echo $link["icon"] ?>" width="40px"
                                    alt="" /></li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="text-center py-1">ALL rights are reserverd to Ouael Sahbi 2022</div>
                </div>
            </div>
            <?php
        }
    }
    // display card 
    public function postCard($post)
    {
    }
    // display filter Box
    public function filterBox($filter)
    {
    }


    public function notFoundPage($message, $errorCode)
    {
        ?>
        <div>Error <?php echo $errorCode ?> </div>
        <div>
            <?php echo $message ?>
        </div>
        <?php
    }

    public function pageHeader($title)
    {
        ?>
        <div class="footer">
            <div class="footerBg"></div>
            <div class="position-relative  pageHeader text-center">
                <?php echo $title ?>
            </div>
        </div>
        <?php
    }

    public function filterInputs($options)
    {
        ?>
        <div class="container mx-auto">
            <div class="d-flex justify-content-between px-4">
                <div class="h1 pb-2 artFont">Filtrer les recettes</div>
                <div class="text-warning py-3" onclick="clearfilter()">Clear filter</div>
            </div>

            <div class="d-flex justify-content-between px-4 mb-3">
                <?php
                foreach ($options as $filterOption) {
                    ?>

                    <div class="flex gap-2 position-relative filterBox ">
                        <p class="h6"><?php echo $filterOption['name'] ?></p>
                        <select name=<?php echo $filterOption['index'] ?> class="selectInput postion-relative"
                            onchange="filter(this.name ,this.value)">
                            <option value="all">Tous</option>
                            <?php foreach ($filterOption["options"] as $option) {
                                ?>
                                <option value="<?php echo $option['id'] ?>" <?php if (sizeof($_GET) > 0 and $_GET[$filterOption['index']] == $option['id']) {
                                       echo "selected";
                                   } ?>>
                                    <?php echo $option['name'] ?>
                                </option>
                                <?php
                            } ?>

                        </select>
                        <div class="p-1 bg-light position-absolute  filterBlur"></div>
                    </div>
                <?php } ?>
                <!-- <div class="flex gap-2 position-relative filterBox  pt-4">
                        <button class="btn btn-yellow " onclick="upplyFilter()">Filtrer</button>
                    </div> -->
            </div>
        </div>

        <?php

    }
}