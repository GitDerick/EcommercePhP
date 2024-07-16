<?php
include './header/header.php';

$id = $_GET['id'];
$creation = getCreationById($id);
if (isset($_POST['ajoutPanier'])) {
    $nombre_de_produit = $_POST['nombre_de_produit_choisi'];
    ajoutPanier($id, $nombre_de_produit);

}
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>

    <main>
        <section>
            <h1>View Produits</h1>

            <form method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input value="<?php echo $creation['nom']; ?>" type="text" class="form-control" id="nom" disabled>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix Unitaire</label>
                    <input value="<?php echo $creation['prix']; ?>" type="number" class="form-control" id="prix"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="nombre_de_produit" class="form-label">Nombre de Produits</label>
                    <input value="<?php echo $creation['nombre_de_produit']; ?>" type="number" class="form-control"
                        id="nombre_de_place" disabled>
                </div>
                <div class="mb-3">
                    <label for="nombre_de_produit_choisi" class="form-label">Nombre de Produits choisi</label>
                    <input type="number" name="nombre_de_produit_choisi" class="form-control" min='1'
                        max="<?php echo $creation['nombre_de_produit']; ?>">
                </div>
                <div class="mb-3">
                    <label for="date_affiche" class="form-label">Date d'affiche</label>
                    <input value="<?php echo $creation['date_affiche']; ?>" type="date-local" class="form-control"
                        id="date_affiche" disabled>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" disabled>
                <?php echo $creation['description']; ?>
                </textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Ajouter Panier" class="btn btn-warning" name='ajoutPanier'>
                    <input type="submit" value="Payer" class="btn btn-warning" name='payer'>
                </div>
            </form>
        </section>
    </main>

</body>
