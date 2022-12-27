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
                    <img src="public/logos/<?php echo $data["logo"] ?>" width="150px" alt="" />
                    <?php
                    // Social Media 
                    foreach ($data["socialmedia"] as $socialMedia) {
                    ?>
                        <li> <?php echo $socialMedia["name"];
                            }

                                ?>
                        </li>
                </div>

                <ul>
                    <?php
                    // Links 
                    foreach ($data["links"] as $link) {
                    ?>
                        <li> <?php echo $link["name"];
                            }
                        }
                                ?>
                        </li>
                </ul>
        </div>
    <?php
    }
    // display Footer 
    public function Footer()
    {
    ?>
       <div class="footer">

       </div>
<?php
        $menu = new menuModel();
        $homeMenu = $menu->getMenu("Home");
        foreach ($homeMenu as $data) {
            // Logo 
            echo $data["logo"];

            // Social Media 
            foreach ($data["socialmedia"] as $socialMedia) {
                echo $socialMedia["name"];
            }

            // Links 
            foreach ($data["links"] as $link) {
                echo $link["name"];
            }
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
}
