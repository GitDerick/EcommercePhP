<?php
include './header/header.php';
$commandes = getAllCommande();
?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>



    <main>
        <section>
            <h1>Gestion Commandes</h1>
            <div class="mb-3">
                <a href="ajoutCreation.php" class="btn btn-primary">Ajouter un Produit</a>
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Date Commande</th>
                        <th scope="col">Les créations => quantite</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($commandes as $commande) {
                        $id_user = $commande['id_user'];
                        $user = getUtilisateurById($id_user);
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $i++; ?>
                            </th>
                            <td>
                                <?php echo $user['nom']; ?>
                            </td>
                            <td>
                                <?php echo $commande['date_commande'] ?>
                            </td>
                            <?php
                            $tab_commande_produit = getCommandeCreationById($commande['id_commande']);

                            ?>
                            <td>
                                <?php foreach ($tab_commande_produit as $key => $value) {
                                    $creation = getCreationById($value['id']);
                                    ?>
                                    <?php echo $creation['nom'] . " => " . $value['nombre_de_produit'] . "<br>"; ?>

                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $commande['total'] ?>
                            </td>

                            <td class="row bg-transparent">
                                <div class="col-3 m-1">
                                    <a href=<?php echo "modifierCreation.php?id=" . $commande['id_commande'] ?>
                                        class="btn btn-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="col-3 m-1">
                                    <a href=<?php echo "supprimerCreation.php?id=" . $commande['id_commande'] ?>
                                        class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>
