<?php
include './header/header.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "achatvente";
$port = 3306;


if (isset($_POST['envoyer'])) {
    //    recuperation des donnees 
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sexe = $_POST['sexe'];
    $mot_de_passe = $_POST['password'];
    $date_de_naissance = $_POST['date_naissance'];
    $c_mot_de_passe = $_POST['c-password'];

    if ($mot_de_passe === $c_mot_de_passe) {
        // connexion a la base de donnee
        $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$conn) {
            die("echec de connexion avec la base de donnee" . mysqli_connect_error());
        }
        // Applcation de mysqli_real_escape_string()
        // 1 niveau de securiter
        $nom = mysqli_real_escape_string($conn, $nom);
        $prenom = mysqli_real_escape_string($conn, $prenom);
        $email = mysqli_real_escape_string($conn, $email);
        $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
        $telephone = mysqli_real_escape_string($conn, $telephone);
        $sexe = mysqli_real_escape_string($conn, $sexe);

        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Utilisateur(nom,prenom,date_de_naissance,email,sexe,mot_de_passe,telephone)
        values(?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        // string (s) int(i)
        $stmt->bind_param("sssssss", $nom, $prenom, $date_de_naissance, $email, $sexe, $mot_de_passe, $telephone);

        $estEnregister = $stmt->execute();

        if ($estEnregister) {
            echo "Utilisateur enregistrer";
        } else {
            echo "Une erreur est survenue";
        }

    }

}

?>






<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vetements prêt à porter</title>
    <link class="logo" rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="formu-apply">

    <section class="container mt-5">
        <form method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom(s) :</label>
                <input type="text" id="prenom" name="prenom" class="form-control">
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe :</label>
                <select id="sexe" name="sexe" class="form-select">
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail :</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Numéro de téléphone :</label>
                <input type="text" id="telephone" name="telephone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de Naissance :</label>
                <input type="date" name="date_naissance" class="form-control" id="date_naissance">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="c-password" class="form-label">Confirmer mot de passe :</label>
                <input type="password" id="c-password" name="c-password" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" name="envoyer" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>
