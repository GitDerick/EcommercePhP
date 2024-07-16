<?php
include './header/header.php';
$id = $_GET['id'];
$creation = getCreationById($id);

if (isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $nombre_de_produit = $_POST['nombre_de_produit'];
    $date_affiche = $_POST['date_affiche'];
    $description = $_POST['description'];

    if (empty($nom) || empty($prix) || empty($nombre_de_produit) || empty($date_affiche)) {
        echo "Remplir tous les champs";
    } else {
        modifierCreation($id, $nom, $prix, $nombre_de_produit, $date_affiche, $description);
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



    <main>
        <section>
            <h1>Modifier Creation</h1>

            <form method="post">
                <img src="<?php echo $creation['chemin']; ?>" width="200" height="200" alt="">
                <div class="mb-3">
                    <label for="image" class="form-label">Importer un produit</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input value="<?php echo $creation['nom']; ?>" type="text" name="nom" class="form-control" id="nom">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix Unitaire</label>
                    <input value="<?php echo $creation['prix']; ?>" type="number" name="prix" class="form-control"
                        id="prix">
                </div>
                <div class="mb-3">
                    <label for="nombre_de_produit" class="form-label">Nombre de Produits</label>
                    <input value="<?php echo $creation['nombre_de_produit']; ?>" type="number" name="nombre_de_produit"
                        class="form-control" id="nombre_de_produit">
                </div>
                <div class="mb-3">
                    <label for="date_affiche" class="form-label">Date d'affiche</label>
                    <input value="<?php echo $creation['date_affiche']; ?>" type="date-local" name="date_affiche"
                        class="form-control" id="date_affiche">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name='description' id="description" rows="3">
                <?php echo $creation['description']; ?>
                </textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Modifier Produit" class="btn btn-primary" name='modifier'>
                </div>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>
