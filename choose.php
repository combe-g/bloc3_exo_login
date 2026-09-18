<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        function filtrer (string $chaine, string $caracteres_autorises) : string
        {
            $resultat = "";

            $caracteres = mb_str_split($chaine, 1, "utf-8");
            $autorises = mb_str_split($caracteres_autorises, 1, "utf-8");

            foreach ($caracteres as $caractere)
            {
                if (in_array($caractere, $autorises, true))
                {
                    $resultat .= $caractere;
                }
            }
            return $resultat;
        }

        function verify_login (array $login) : bool
        {
            $caracteres_autorises = "abcdefghijklmnopqrstuvwxyzéèç";
            $retour = true;
            $taille_max_prenom = 3;
            $taille_max_nom_famille = 20;

            if (mb_strlen($login[0], "utf-8") > $taille_max_nom_famille)
            {
                $retour = false;
            }

            if (mb_strlen($login[1], "utf-8") > $taille_max_prenom)
            {
                $retour = false;
            }

            $caracteres = mb_str_split("$login[0]$login[1]", 1, "utf-8");
            $autorises = mb_str_split($caracteres_autorises, 1, "utf-8");
        
            foreach ($caracteres as $caractere)
            {
                if (!in_array($caractere, $autorises, true))
                {
                    $retour = false;
                }
            }
        
            return $retour;

        }

        function generate_login (string $first_name, string $last_name) : array
        {
            $taille_max_nom_famille = 20;
            $caracteres_autorises = "abcdefghijklmnopqrstuvwxyzéèç";

            $login = ["", ""];

            if ($first_name AND $last_name)
            {
                $last_name = mb_strtolower($last_name, "utf-8");
                $first_name = mb_strtolower($first_name, "utf-8");

                $last_name = filtrer($last_name, $caracteres_autorises);
                $first_name = filtrer($first_name, $caracteres_autorises);

                if (mb_strlen($last_name, "UTF-8") > $taille_max_nom_famille)
                {
                    $last_name = mb_substr($last_name, 0, $taille_max_nom_famille, "UTF-8");
                }
                else $login[0] .= $last_name;

                $login[1] .= $first_name[0];
            }

            return $login;
        }
    ?>

    <nav>
        <a href="index.php">Modifier le nom ou le prénom</a>
    </nav>

    <main>
        <?php
            $login = ["", ""];
            $nom = "";
            $prenom = "";
            $separateur = ".";

            if (isset($_POST["nom"]) AND isset($_POST["prenom"]))
            {
                $nom = $_POST["nom"];

                $prenom = $_POST["prenom"];
    
                $login = generate_login($prenom, $nom);
            }

            if (isset($_POST["login_nom"]) AND isset($_POST["login_prenom"]))
            {
                if (verify_login(["$_POST[login_nom]", "$_POST[login_prenom]"]))
                {
                    $login = ["$_POST[login_nom]", "$_POST[login_prenom]"];

                    echo "Le login a été modifié.<br>";
                }
                else echo "Le login a été réinitialisé.<br>";
            }


            echo "Login proposé : $login[0].$login[1]";
        ?>
        
        <br>
        Vous pouvez modifier le login puis le vérifier en selectionnant Vérifier.
        <br>
        Le nom de famille ne peut pas être de plus de 20 caractères, et le prénom de plus de 3 caractères.
        <br>
        Les minuscules de a à z sont autorisées, ainsi que é, è et ç.

        <form method="post">
            <input required type="text" name="login_nom" value="<?php echo "$login[0]" ?>">
            <?php echo $separateur ?>
            <input required type="text" name="login_prenom" value="<?php echo "$login[1]" ?>">

            <input type="submit" formaction="choose.php" value="Vérifier">
            <input type="submit" formaction="final.php" value="Accepter">

            <input type="hidden" name="nom" value="<?php echo $nom ?>" >
            <input type="hidden" name="prenom" value="<?php echo $prenom ?>" >
        </form>
    </main>
</body>

</html>

