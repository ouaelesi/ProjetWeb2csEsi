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
                                <li><a href="/ProjetWeb<?php echo $link['href'] ?>" class="text-decoration-none text-light"><img class="d-block " src="public/images/socialMedia/<?php echo $link["icon"] ?>" width="20px" alt="" /></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between">
                        <img src="public/logos/<?php echo $data["logo"] ?>" width="150px" alt="" role="button" onclick="gotoUrl('/ProjetWeb/')"/>
                        <ul class="d-flex ">
                            <?php
                            foreach ($data['links'] as $link) {
                                $cookie_name = "logedIn_user";

                                if ($link["type"] == "button") {
                                    if (!isset($_COOKIE[$cookie_name])) {

                            ?>
                                        <a href="/ProjetWeb<?php echo $link["href"] ?>" class="text-decoration-none text-light">
                                            <button class="btn btn-yellow my-auto"><?php echo $link['name'] ?></button>
                                        </a>

                                    <?php
                                    } else {
                                        $userController = new userController();
                                        $user = $userController->getUserById($_COOKIE[$cookie_name])
                                    ?>
                                        <div class="d-flex gap-2">
                                            <a class="text-light text-decoration-none" href="/ProjetWeb/profile?id=<?php echo $_COOKIE[$cookie_name]; ?>">
                                                <div class="bluredBox rounded-5 profileBox ps-3 py-1  d-flex gap-3"><span class="pt-1 text-white"><?php echo $user['firstName'] . ' ' . $user['lastName'] ?></span><img src="/ProjetWeb/public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                                                                                                                                                                                                                echo $user["photo"];
                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                echo "avatarprofile.webp";
                                                                                                                                                                                                                                            } ?>" width="33px" class=" me-2 rounded-circle" /> </div>
                                            </a>
                                            <div>
                                                <div onclick="switchMode()" role="button" class="bluredBox profileBox p-1 rounded-circle" id="themeSwitch"> <img src="/ProjetWeb/public/icons/sun.png" width="31px" height="31px" class=" d-block my-auto rounded-circle" /></div>
                                            </div>
                                            <div>
                                                <div onclick="logout()" role="button" class="bluredBox profileBox p-1 rounded-circle"> <img src="/ProjetWeb/public/icons/logout.png" width="31px" height="31px" class=" d-block my-auto rounded-circle" /></div>
                                            </div>
                                        
                                        </div>

                            <?php

                                    }
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
        <ul class="d-flex gap-4 justify-content-around nav-links mx-auto  mb-5" id="stickyNav">
            <img src="public/logos/<?php echo $data["logo"] ?>" width="100px" alt="" class="hiddenToNav" />
            <?php
                foreach ($data['links'] as $link) {
                    if($link["type"] != "button"){
            ?>
                <li class="py-2 <?php if ($link["type"] == "button") echo "hiddenToNav" ?>">
                    <a href="/ProjetWeb<?php echo $link["href"] ?>" class="<?php if ($link["type"] == "button") echo "text-warning underline";
                                                                            else echo "text-light text-decoration-none " ?>">

                        <?php echo $link['name'] ?>
                    </a>
                </li>
            <?php
                }
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
            <div class="footerBg bg-dark"></div>
            <div class="position-relative pt-4 pb-2"> <img class="d-block mx-auto" src="public/logos/<?php echo $data["logo"] ?>" width="150px" alt="" />
                <ul class="d-flex gap-4 justify-content-around footer-nav-links mx-auto mt-5 mb-5">
                    <?php
                    foreach ($data['links'] as $link) {
                    ?>
                        <li><a href="/ProjetWeb<?php echo $link['href'] ?>" class="text-decoration-none text-light"><?php echo $link['name'] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="d-flex gap-4 justify-content-around footer-socialMedia mx-auto mb-5 ">
                    <?php
                    foreach ($data['socialmedia'] as $link) {
                    ?>
                        <li><a href="/ProjetWeb<?php echo $link['href'] ?>" class="text-decoration-none text-light"><img class="d-block mx-3" src="public/images/socialMedia/<?php echo $link["icon"] ?>" width="40px" alt="" /></a></li>
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
            $this->NavBar(null);
            // header 
            $this->pageHeader("OOPS !", "oops.png");
            // navLinks 
            $this->navLinks();
    ?>
    <div class="text-center text-warning  largeText"> <?php echo $errorCode ?> </div>
    <div class="text-center  h2">
        <?php echo $message ?>
    </div>
<?php
        }


        public function pageHeader($title, $bg)
        {
?>
    <div class=" position-relative overflow-hidden">
        <img src="/ProjetWeb/public/images/<?php echo $bg ?>" class="bg-dark position-absolute bottom-0 opacity-25" width="100%" />
        <!-- <div class="footerBg"></div> -->
        <div class="position-relative  pageHeader text-center ">
            <?php echo $title ?>
        </div>
    </div>
<?php
        }

        public function filterInputs($options, $message)
        {
?>
    <div class="container-xl mx-auto filterINputs ">
        <div class="d-flex justify-content-between px-4">
            <div class="h1 pb-2 artFont"><?php echo $message ?></div>
            <div class="text-warning py-3" role="button" onclick="clearfilter()">Clear filter</div>
        </div>

        <div class="d-flex justify-content-between px-4 mb-3 flex-wrap">
            <?php
            foreach ($options as $filterOption) {
            ?>

                <div class="flex gap-2 my-2 position-relative filterBox ">
                    <p class="h6"><?php echo $filterOption['name'] ?></p>
                    <select name=<?php echo $filterOption['index'] ?> class="selectInput bluredBox postion-relative" onchange="filter(this.name ,this.value)">
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


        public function signUpForm()
        {
?>
    <div class=" py-5">
        <img src="public/images/footerBg.png" width="100%" height="100%" class="bg-dark position-absolute top-0 opacity-50" />
        <?php $this->NavBar(""); ?>
        <div class="bluredBox px-3 pt-4 pb-2  registerForm mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                S'inscrire
            </div>
            <p class="text-center px-5">This is some text this some text this some text this some text this some text this some text this some text this is some text this is some text</p>
            <form class="row" method="POST" action="/ProjetWeb/api/apiRoute.php">
                <div class="col-6">
                    <div class="my-2">
                        <label class="mb-1">Role</label>
                        <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name='role'>
                            <option value="utilisateur">utilisateur simple</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label class="mb-1">Nom</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Nom" name="lastName" />
                    </div>
                    <div class="my-2">
                        <label class="mb-1">Mot de passe</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="password" required placeholder="Mot de passe" name="password" />
                    </div>
                    <div class="my-2">
                        <label class="mb-1">Sex</label>
                        <select class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>


                </div>
                <div class="col-6">
                    <div class="my-2">
                        <label class="mb-1">Email</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="email" required placeholder="Email" name="email" />
                    </div>
                    <div class="my-2">
                        <label class="mb-1">Prénom</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Prénom" name="firstName" />
                    </div>
                    <div class="my-2">
                        <label class="mb-1">confirmer le mot de passe</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="password" required placeholder="Mot de passe" name="confirmPsw" />
                    </div>
                    <div class="my-2">
                        <label class="mb-1">Date de néssance</label>
                        <input class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="date" required name="dateOfBirth" />
                    </div>
                </div>
                <div class="row my-2  px-0 mx-0">
                    <div class="col-6 py-1">Vous avez déja un compte ? <a class="text-warning" href="/ProjetWeb/login">Se connecter</a></div>
                    <div class="col-6"><button class="btn btn-red d-block ms-auto px-3" type="submit" name="signUp">S'inscrire</button></div>
                </div>
            </form>

        </div>

    </div>
<?php
        }


        public function loginForm()
        {
?>
    <div class=" py-5 ">
        <img src="public/images/footerBg.png" width="100%" height="100%" class="bg-dark position-absolute top-0 opacity-50" />
        <?php $this->NavBar(""); ?>
        <div class="bluredBox px-3 pt-4 pb-2  loginForm  mx-auto rounded-3 position-relative">
            <div class="artFont text-center h1">
                Se Connecter
            </div>
            <p class="text-center px-5">Welcome Again</p>
            <div>
                <div id="loginAlert">

                </div>
                <div class="my-2">
                    <label class="mb-1">Email</label>
                    <input id="loginEmail" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="text" required placeholder="Email" name="email" />
                </div>
                <div class="my-2">
                    <label class="mb-1">Mot de passe</label>
                    <input id="loginPassword" class="bluredBox px-2 py-2 d-block rounded-1 w-100 text-light" type="password" required placeholder="Mot de passe" name="password" />
                </div>


                <div class="row my-2 mt-5  px-0 mx-0">
                    <div class="col-6 py-1">Vous n'avez pas un compte ? <a class="text-warning" href="/ProjetWeb/signUp">s'inscrire</a></div>
                    <div class="col-6"><button class="btn btn-red d-block ms-auto px-3" onclick="login()" name="logIn">Se Connecter</button></div>
                </div>
            </div>

        </div>

    </div>
<?php
        }
    }
