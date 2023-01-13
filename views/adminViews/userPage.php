<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/views/adminViews/sharedAdminView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/controllers/userController.php");

class userPage
{
    public function usersList()
    {
        $userController = new userController();
        $allUser = $userController->getallUser();

?>
        <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 mt-5 TableHeader" role="button">
            <div class="col-4"> User</div>
            <div class="col-3">Email</div>
            <div class="col-2">Role</div>
            <div class="col-2">Status</div>
            <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
        </div>
        <?php
        foreach ($allUser as $user) {
        ?>
            <div class="d-flex bluredBox px-3 py-3 rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/user?id=<?php echo $user['id'] ?>')">
                <div class="col-4 "> <img src="/ProjetWeb/public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                                                    echo $user["photo"];
                                                                                } else {
                                                                                    echo "avatarprofile.webp";
                                                                                } ?>" width="30px" class=" me-2 rounded-circle" /> <span class="pt-2"><?php echo $user['firstName'];
                                                                                                                                                        echo " ";
                                                                                                                                                        echo $user['lastName'] ?></span> </div>
                <div class="col-3"><?php echo $user['email'] ?></div>
                <div class="col-2"><?php echo $user['role'] ?></div>
                <div class="col-2">
                    <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($user['status'] == 'valid') echo 'bg-success';
                                                                                    else if ($user['status'] == 'rejected') echo 'bg-danger';
                                                                                    else echo 'bg-warning' ?>"><?php echo $user['status'] ?></div>
                </div>
                <div class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></div>
            </div>
        <?php
        }
        ?>
    <?php
    }

    public function filterSection()
    {
    ?>
        <div class="d-flex">
            <div class="col-4">
                <div class="d-flex ">
                    <div class=" py-4 mt-1"></div>
                </div>
                <div class="flex gap-2 position-relative filterBox w-100">
                    <p class="h6">chercher un utilisateur</p>
                    <div class="selectInput postion-relative d-flex w-100 justify-content-between">
                    <input class="bg-transparent border-0" placeholder="Nom de l'utilsateur ..."/> <img src="/ProjetWeb/public/icons/search.png" width="30px" class="mx-2" />
                    </div>
                  
                    <div class="p-1 bg-light position-absolute  filterBlur"></div>
                </div>

            </div>
            <div class="col-8">
                <?php $sharedComponents = new sharedViews();
                $sharedComponents->filterInputs([
                    [
                        "name" => "status",
                        "index" => "status",
                        "options" => [
                            ["id" => "pending", "name" => "pending"],
                            ["id" => "rejected", "name" => "rejected"],
                            ["id" => "valid", "name" => "valid"],
                        ]
                    ],
                    [
                        "name" => "Role",
                        "index" => "role",
                        "options" => [
                            ["id" => "admin", "name" => "admin"],
                            ["id" => "utilisateur", "name" => "utilisateur"]
                        ]
                    ],
                    [
                        "name" => "Sex",
                        "index" => "sex",
                        "options" => [
                            ["id" => "male", "name" => "male"],
                            ["id" => "female", "name" => "female"]
                        ]
                    ]
                ], "");
                ?>
            </div>
        </div>
<?php
    }

    public function displayUserspage()
    {
        // imports 
        $sharedViews = new sharedadminView();
        // page title
        $sharedViews->pageHeader('Liste des utilisateurs');
        // filter section 
        $this->filterSection();
        // Users tabe
        $this->usersList();
    }
}
