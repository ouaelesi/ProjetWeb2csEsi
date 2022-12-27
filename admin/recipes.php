<?php
// session_start();
// // Check if the user is logedin 
// if (!isset($_SESSION['username'])) {
//     header("Location:loginForm.php");
// }
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../jquery-3.6.0.min.js"></script>
    <script src="./index.js"></script>
    <link rel='stylesheet' href="../css/style.css">
    <title>admin Dashboard</title>
</head>
<?php
require_once "../views/adminViews/recipeViews.php";
$view = new AdminRecipeViews();
$view->displayAdminRecipePage();

