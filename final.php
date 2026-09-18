<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <a href="index.php">Modifier le nom ou le prénom</a>
    </nav>

    <main>
        <?php

            if (isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["login_nom"]) AND isset($_POST["login_nom"]))
            {
                echo "<table><tr><td>Nom :</td><td>$_POST[nom]</td></tr>
                      <tr><td>Prenom :</td><td>$_POST[prenom]</td></tr>
                      <tr><td>Login choisi :</td><td>$_POST[login_nom].$_POST[login_prenom]</td></tr></table>";
            }
        ?>
    </main>
</body>

</html>