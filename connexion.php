<?php
session_start();

/**
 * Utilisateur principal : tom@holland
 * Mot de passe : tom
 */

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "achatvente";
$port = 3306;

if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    if (!empty($email) && !empty($password)) {
        $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$conn) {
            die("echec de connexion avec la base de donnee" . mysqli_connect_error());
        }
        // select * from utilisateur where email= "toto@rentrer.com" and mot_de_passe=toto1234;
        $sql = 'SELECT * FROM utilisateur WHERE email = ?';

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $resultat = $stmt->get_result();

        $resultatUtilisateur = $resultat->fetch_assoc();

        if (password_verify($password, $resultatUtilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur'] = $resultatUtilisateur;
            header("Location: ./Hommes.php");
        } else {
            // http://localhost/dashboard/projet433/film/connexion.php?erreur=empw
            header("Location: ./connexion.php?erreur=empw");
        }
        // var_dump($resultatUtilisateur);
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://getbootstrap.com/" id="lienBoots">
                    <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/612612-modele-de-concept-de-design-logo-vetements-femme-et-homme-vectoriel.jpg"
                        alt="logo" style="width: 50px; height: 50px;" class="rounded-pill">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="Hommes.php">Articles</a>
                        </li>
                        <?php
                        if (isset($_SESSION['utilisateur'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Compte</a>
                            </li>
                            <li><a href="#">Deconnexion</a></li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">Inscription</a>
                            </li>
                        <?php }
                        ?>


                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <h1>Connexion</h1>
            <div class="container">
                <form method="POST">
                    <div class="container position-absolute top-50 start-50 translate-middle">
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input id="txtEmail" name="email" type="email" placeholder="Entrer Email"
                                class="form-control">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input id="txtPassword" name="mot_de_passe" placeholder="Entrer mot de passe"
                                type="password" class="form-control">
                        </div>
                        <div class="mb-3 form-check">
                            <input id="ckConnecter" class="form-check-input" />
                            <label class="form-check-label" for="exampleCheck1">Rester Connecter</label>
                        </div>
                        <?php
                        if (isset($_GET['erreur'])) {
                            if ($_GET['erreur'] === "empw") {
                                echo "<label id='lblError' class='form-text text-danger'>Email ou Mot de passe invalid
                                !</Label>";
                            }
                        }
                        ?>
                        <br>
                        <br>
                        <input id="connexion" type="submit" class="btn btn-primary" name="connexion"
                            value="connexion" />
                    </div>
                </form>
            </div>

        </section>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>
