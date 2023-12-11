<!DOCTYPE html>
<html>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $speudo = isset($_SESSION['speudo']) ? $_SESSION['speudo'] : "";
}
?>

<head>
    <meta charset="UTF-8">
    <title>page</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['speudo'])) {
        echo "<div>$speudo</div>"; 
        ?>
        <div id="user">
            <form method="post" action="controlleur/deconnexion.php">
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    <?php } ?>