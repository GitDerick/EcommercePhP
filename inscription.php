<?php
include './header/header.php';
// $mdp ="Tom1234";
// echo $mdp."<br>";
// $mdpHash =password_hash($mdp,PASSWORD_DEFAULT);
// echo $mdpHash."<br>";
// $mdp ="Tom12346";
// if (password_verify($mdp,$mdpHash)) {
//     echo "Identique";
// }
// else{
//     echo "No match";
// }


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
  <title>Vetements pret à porter</title>
  <link class="logo" rel="stylesheet" href="inscription.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body class="formu-apply">


  <section>

    <form method="post">
      <div>
        <h2 class="h1">Inscription</h2><br>
        <div>
          <label for="nom">Nom : </label><br>
          <input type="text" id="nom" name="nom" size="50"><br>
        </div>
        <div>
          <label for="prenom(s)">Prenom(s) : </label><br>
          <input type="text" id="prenom" name="prenom" size="50"><br>
        </div>
        <div>
          <label for="sexe">Sexe : </label><br>
          <select id="sexe" name="sexe">
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
          </select><br>
        </div>
        <div>
          <label for="Adresse">Adresse : </label><br>
          <input type="text" id="Adresse" name="Adresse" size="50"><br>
        </div>
        <div>
          <label for="email">Adresse mail : </label><br>
          <input type="text" size="50" id="email" name="email"><br>
        </div>
        <div>
          <label for="telephone">Numéro de téléphone : </label><br>
          <input type="text" size="50" id="telephone" name="telephone"><br>
        </div>
        <div class="mb-3">
          <label for="date_naissance" class="form-label">Date de Naissance</label>
          <input type="date" name="date_naissance" class="form-control" id="date_naissance">
        </div>
        <div>
          <label for="Numero">Mot de passe : </label><br>
          <input type="text" id="Numero" name="password" size="50">
        </div><br>
        <div>
          <label for="Numero">Confirmer mot de passe : </label><br>
          <input type="text" id="Numero" name="c-password" size="50">
        </div><br>
        <div>
          <button type="submit" name="envoyer">Soumettre</button>
        </div>
      </div>




    </form>

  </section>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
</body>

</html>
