<?php
if (session_id() === "") {
    session_start();
}
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];


?>

<!DOCTYPE html>

<html lang="en">

<head>
        <title>Bite Help</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="main.css">
    <?php
foreach ($scriptList as $script) {
    echo "<script src='$script'></script>";
}



?>
</head>


        <header id="maiaHeader">
            <a href="index.php"><h1 style="display: inline; color: red;" id="MaiaTitle">BITE</h1><h1 style="display: inline; color: whitesmoke;">HELP</h1></a>

            <?php include("nav.php");?>


        </header>
<body>
