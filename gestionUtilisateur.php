<?php
include './header/header.php';

$users = getAllUser();
$i = 0;
?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>



    <main>
        <section>
            <h1>Gestion Utilisateurs</h1>
            <div class="mb-3">
                <a href="ajouterUtilisateur.php" class="btn btn-primary">Ajouter un utilisateur</a>
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Email</th>
                        <th scope="col">Télephone</th>
                        <th scope="col" class="bg-transparent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>


                        <tr>
                            <th scope="row">
                                <?php echo ++$i; ?>
                            </th>
                            <th scope="row"><img src="<?php echo $user['nom']; ?>" alt=""></th>
                            <td>
                                <?php echo $user['prenom']; ?>
                            </td>
                            <td>
                                <?php echo $user['sexe']; ?>
                            </td>
                            <td>
                                <?php echo $user['date_de_naissance']; ?>
                            </td>
                            <td>
                                <?php echo $user['email'] ?>
                            </td>
                            <td>
                                <?php echo $user['telephone'] ?>
                            </td>
                            <td class="row bg-transparent">
                                <div class="col-3 m-1">
                                    <a href=<?php echo "modifierUtilisateur.php?id=" . $user['id']; ?>
                                        class="btn btn-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="col-3 m-1">
                                    <a href=<?php echo "supprimerUtilisateur.php?id=" . $user['id']; ?>
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
