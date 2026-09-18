<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
    <form action="choose.php" method="post">
        <table>
        <tr>
            <td><label>Prénom :</label></td>

            <td><input required type="text" name="prenom"></td>
        </tr>
        
        <tr>
            <td><label>Nom :</label></td>

            <td><input required type="text" name="nom"></td>
        </tr>

        <tr><td><input type="submit" value="Envoyer"></tr></td>
    </form>
    </main>
</body>

</html>