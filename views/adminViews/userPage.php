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
        <table data-search="true" data-toggle="table" class="table-style">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">

                    <th data-sortable="true" class="col-4"> User</th>
                    <th data-sortable="true" class="col-3">Email</th>
                    <th data-sortable="true" class="col-2">Role</th>
                    <th data-sortable="true" class="col-2">Status</th>
                    <th data-sortable="true" class="col-1 "><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($allUser as $user) {
                ?>
                    <a href='/ProjetWeb/admin/user?id=<?php echo $user['id'] ?>'>
                        <tr class="d-flex bluredBox   rounded-1 justify-content-between my-2 TableRow">

                            <th class="col-4  text-light "> <img src="/ProjetWeb/public/images/profile/<?php if ($user["photo"] != null and $user["photo"] != "") {
                                                                                                            echo $user["photo"];
                                                                                                        } else {
                                                                                                            echo "avatarprofile.webp";
                                                                                                        } ?>" width="30px" class=" me-2 rounded-circle" /> <a href='/ProjetWeb/admin/user?id=<?php echo $user['id'] ?>' class="text-light pt-2"><?php echo $user['firstName'];
                                                                                                                                                                                                                                                echo " ";
                                                                                                                                                                                                                                                echo $user['lastName'] ?></a> </th>
                            <th class="col-3 text-light "> <?php echo $user['email'] ?></th>
                            <th class="col-2 text-light "><?php echo $user['role'] ?></th>
                            <th class="col-2 text-light ">
                                <div class="w-50 mx-auto text-center text-light py-1 rounded-1 <?php if ($user['status'] == 'valid') echo 'bg-success';
                                                                                                else if ($user['status'] == 'rejected') echo 'bg-danger';
                                                                                                else echo 'bg-warning' ?>"><?php echo $user['status'] ?></div>
                            </th>
                            <th class="col-1  text-light "><a href='/ProjetWeb/admin/user?id=<?php echo $user['id'] ?>'><img src="/ProjetWeb/public/icons/edit.png" width='20px' height="20px" class="d-block mx-auto" /></a></th>

                        </tr>
                    </a>
                <?php
                }
                ?>
            </tbody>
        </table>


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
                        <input class="bg-transparent border-0" placeholder="Nom de l'utilsateur ..." /> <img src="/ProjetWeb/public/icons/search.png" width="30px" class="mx-2" />
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
        // $this->filterSection();
        // Users tabe
        $this->usersList();
    }
}
