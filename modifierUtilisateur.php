<?php
include './header/header.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = getUserById($id);
} else {
    header("Location: gestionUtilisateur.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'sexe' => $_POST['sexe'],
        'date_de_naissance' => $_POST['date_de_naissance'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone']
    ];

    if (UpdateUser($id, $update_data)) {
        header("Location: gestionUtilisateur.php");
        exit();
    }
}

/*if (isset($_POST['update'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $mot_de_passe = $_POST['password'];
    $c_mot_de_passe = $_POST['c_password'];
    $telephone = $_POST['telephone'];
    if (!empty($nom) && !empty($prenom) && !empty($date_de_naissance) && !empty($email) && !empty($sexe) && !empty($mot_de_passe) && !empty($c_mot_de_passe) && !empty($telephone)) {
        if ($c_mot_de_passe === $mot_de_passe) {
            UpdateUser($id, $nom, $prenom, $sexe, $date_de_naissance, $email, $mot_de_passe, $telephone);
        }
    }
}*/

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vetements pret à porter</title>
    <link class="logo" rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body class="formu-apply">


    <section>

        <form method="post">
            <div>
                <div>
                    <label for="nom">Nom : </label><br>
                    <input type="text" id="nom" name="nom" size="50" value="<?php echo $user['nom']; ?>"><br>
                </div>
                <div>
                    <label for="prenom(s)">Prenom(s) : </label><br>
                    <input type="text" id="prenom" name="prenom" size="50" value="<?php echo $user['prenom']; ?>"><br>
                </div>
                <div>
                    <label for="sexe">Sexe : </label><br>
                    <select id="sexe" name="sexe" value="<?php echo $user['sexe']; ?>">
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select><br>
                </div>
                <div>
                    <label for="email">Adresse mail : </label><br>
                    <input type="text" size="50" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
                </div>
                <div>
                    <label for="telephone">Numéro de téléphone : </label><br>
                    <input type="text" size="50" id="telephone" name="telephone"
                        value="<?php echo $user['telephone']; ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="date_de_naissance" class="form-label">Date de Naissance</label>
                    <input type="date" name="date_de_naissance" class="form-control" id="date_de_naissance"
                        value="<?php echo $user['date_de_naissance']; ?>">
                </div>
                <div>
                    <button type="submit" name="envoyer">Modifier</button>
                </div>
            </div>




        </form>

    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>
