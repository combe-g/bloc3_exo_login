<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
    <?php
        function filtrer(string $chaine, string $caracteres_autorises) :  string
        {
            $resultat = "";

            for ($indice = 0; $indice < strlen($chaine); $indice++)
            {
                $caractere = $chaine[$indice];
                if (strpos($caracteres_autorises, $caractere) !== false)
                {
                    $resultat .= $caractere;
                }
            }
            return $resultat;
        }

        function generate_login (string $first_name, string $last_name) : string
        {
            $taille_max_nom_famille = 20;
            $separateur = '.';
            $caracteres_autorises="abcdefghijklmnopqrstuvwxyzéèç";

            $login = "";

            if ($first_name AND $last_name)
            {
                $last_name = mb_strtolower($last_name, "UTF-8");
                $first_name = mb_strtolower($first_name, "UTF-8");

                $last_name = filtrer($last_name, $caracteres_autorises);
                $first_name = filtrer($first_name, $caracteres_autorises);

                if (strlen($last_name) > 20)
                {
                    for ($indice = 0; $indice <= $taille_max_nom_famille; $indice++)
                    {
                        $login .= $last_name[$indice];
                    }
                }
                else $login .= $last_name;

                $login .= $separateur;

                $login .= $first_name[0];
            }

            return $login;
        }
    ?>

    <nav>
        <a href="index.php">Modifier le nom ou le prénom</a>
    </nav>

    <main>
        <?php
            $login = "";
            if (isset($_POST["nom"]) AND isset($_POST["prenom"]))
            {
                $nom = $_POST["nom"];

                $prenom = $_POST["prenom"];
    
                $login = generate_login($prenom, $nom);
            }

            if (isset($_POST["login"]))
            {
                $login = $_POST["login"];
            }
        ?>

        <form method="post">
            <label>
                Login proposé :
                <input required type="text" name="login" value="<?php echo $login ?>">
            </label>

            <input type="submit" formaction="choose.php" value="Vérifier">
            <input type="submit" formaction="final.php" value="Accepter">
            <input type="hidden" name="login" value="<?php echo $login ?>" >
        </form>
        Vous pouvez modifier le login puis le vérifier en selectionnant Vérifier.
    </main>
</body>

</html>

