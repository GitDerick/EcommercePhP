<?php
session_start();
include './includes/fonction.php';
$cpt = countPanier();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site de vente</title>
    <link class="logo" rel="stylesheet" href="#">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>



    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://getbootstrap.com/" id="lienBoots">
                <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/612612-modele-de-concept-de-design-logo-vetements-femme-et-homme-vectoriel.jpg"
                    alt="logo" style="width: 50px; height: 50px;" class="rounded-pill">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
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
                            <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="panier.php" class="btn btn-info"><i class="bi bi-cart4">
                                    <?php echo countPanier(); ?>
                                </i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gestion
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="gestionCreation.php">Gestion de produits</a>
                                <a class="dropdown-item" href="gestionUtilisateur.php">Gestion des utilisateurs</a>
                                <a class="dropdown-item" href="gestionCommande.php">Gestion des commandes</a>
                                <a class="dropdown-item" href="ajouterUtilisateur.php">Ajouter utilisateurs</a>
                                <a class="dropdown-item" href="ajoutCreation.php">Ajout de produits</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inscription.php">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>


</body>
