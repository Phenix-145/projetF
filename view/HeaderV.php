<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>page</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['login'])) {
        ?>
        <div id="user">
            <form method="post" action="controlleur/deconnexion.php">
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    <?php } ?>