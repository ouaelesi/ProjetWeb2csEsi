<?php

class notificationsPage
{
    public function emailsSection()
    {
        // imports 
        $sharedViews = new sharedadminView();
        $sharedViews->pageHeader('La liste des email');
        $userController = new userController();
        $messages = $userController->getAllMessages();

?>
        <table data-search="true" data-toggle="table" class="table-style">
            <thead>
                <tr class="d-flex bluredBox rounded-1 justify-content-between my-2 mt-3 TableHeader" role="button">
                    <th data-sortable="true" class="col-3">User</th>
                    <th data-sortable="true" class="col-3">subject</th>
                    <th data-sortable="true" class="col-5">message</th>
                    <th data-sortable="true" class="col-1">details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($messages as $message) {

                    $user = $userController->getUserById($message['userID']);

                ?>
                    <tr class="d-flex bluredBox  rounded-1 justify-content-between my-2 TableRow" role="button" onclick="gotoUrl('/ProjetWeb/admin/recette?id=<?php echo $message[0] ?>')">
                        <td class="col-3  text-light d-flex gap-2 pt-3"><img src="/ProjetWeb/public/images/profile/<?php echo $user['photo'] ?>" class="rounded-circle" width="25px" height="25px" /><?php echo $user['firstName'] ?> <?php echo $user['lastName'] ?></td>
                        <td class="col-3 text-center text-light  pt-3"><?php echo $message['subject'] ?></td>
                        <td class="col-5 text-center text-light  pt-3"><?php echo $message['body'] ?></td>

                        <td class=" text-light col-1 d-flex justify-content-center gap-3 "><button class="btn btn-yellow" onclick="gotoUrl('/ProjetWeb/admin/editnews?id=<?php echo $message[0] ?>')">details</button> </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    }
    public function displayNotificationsPage()
    {
        $this->emailsSection();
    }
}
