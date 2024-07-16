<?php
include './header/header.php';
$totals = 0;
echo datetime();

//var_dump($_POST);
$tabs = getPaniers();
if (isset($_POST['supprimerPanier'])) {
    $id = $_POST['id_creation'];
    supprimerPanier($id);
}
if (isset($_POST['modifierPanier'])) {
    $id = $_POST['id_creation'];
    $quantite = $_POST['quantiterDemander'];

    ajoutPanier($id, $quantite, true);
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
            <h1>Panier</h1>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Nombre de Produit</th>
                        <th scope="col">Nombre de Produit Souhaiter</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($tabs as $id_creation => $quantite) {
                        $creation = getCreationById($id_creation);
                        ?>


                        <tr>
                            <th scope="row"><input type="hidden" name="id_creation" value="<?php echo $creation['id'] ?>">
                            </th>
                            <td>
                                <?php echo $creation['nom'] ?>
                            </td>
                            <td>
                                <?php echo $creation['prix'] ?>
                            </td>
                            <td>
                                <?php echo $creation['nombre_de_produit'] ?>
                            </td>
                            <form action="" method="post">
                                <td><input type="number" name="quantiterDemander"
                                        max="<?php echo $creation['nombre_de_produit'] ?>" value="<?php echo $quantite ?>"
                                        min="0">
                                </td>
                                <td>
                                    <?php echo $creation['date_affiche'] ?>
                                </td>
                                <td>
                                    <?php echo $creation['description'] ?>
                                </td>
                                <td class="row bg-transparent">
                                    <div class="col-3 m-1">
                                        <button type="submit" name="modifierPanier" class="btn btn-success">
                                            <i class="bi bi-pencil-square"></i>
                                            </a>
                                    </div>
                                    <div class="col-3 m-1">
                                        <button type="submit" name="supprimerPanier" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                            </a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>

            <div class="text-success col-auto text-end">
                <div class="text-success">
                    Totals:
                    <?php echo $totals; ?>
                </div>
                <form method="post">
                    <div>
                        <button class="btn btn-warning" type="submit" name="payer">Payer</button>
                    </div>
                </form>
            </div>
            <div id="paypal-payment-button"></div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>

    <script
        src="https://www.paypal.com/sdk/js?client-id=AYzHvgweA9Wlv_D0GsOZJmHJ1hRSBx9Ls8qFBnO3LoQDrqyvhSR0H_b_N2iFL3d2cnCP-ErYWgizLewM&currency=CAD"></script>
    <script src="./header/paypal.js"></script>
</body>

<?php
if (isset($_POST['payer'])) {
    if (isset($_SESSION['utilisateur'])) {
        $id_utilisateur = $_SESSION['utilisateur']['id'];
        ajouterCommande($totals, $id_utilisateur);
    } else {
        header(("Location: ./connexion.php"));
    }

}
?>
