<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vetements pret à porter</title>
  <link class="logo" rel="stylesheet" href="hommes.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
  <?php include './header/header.php';
  $creations = getCreations();

  ?>

  <header>
    <div id="logo">Vêtements pour hommes</div>
    <nav>
      <ul>
        <li>Vestes</li>
        <li>Pantalons</li>
        <li>Shorts</li>
        <li>Tshirts</li>
      </ul>
    </nav>
  </header>


  <section>
    <div class="row">
      <?php foreach ($creations as $creation) { ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card text-center">
            <a href=<?php echo "produit.php?id=" . $creation['id']; ?>>
              <img src=<?php echo $creation['chemin'] ?> class="card-img-top" alt="">
            </a>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $creation['nom']; ?>
              </h5>
              <p class="card-text">
                <?php echo $creation['prix'] ?>$
                <?php echo $creation['nombre_de_produit'] ?>
                <?php echo $creation['description'] ?>
              </p>
              <form class="col-12 m-1">
                <a href=<?php echo "viewCreation.php?id=" . $creation['id'] ?> class="btn btn-warning">
                  <p>Ajouter Panier</p>
                </a>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>




  <div class="tendances">
    <h3><u>Tendances de la mode</u></h3>
    <p>Découvrez les dernières tendances de la mode pour femmes.</p>
  </div>

  <div class="conseils">
    <h3><u>Conseils de mode</u></h3>
    <p>Obtenez des conseils de style pour créer des tenues élégantes.</p>
  </div>

  <div class="collections">
    <h3><u>Collections thématiques</u></h3>
    <p>Découvrez nos collections pour différentes occasions et saisons.</p>
  </div>

  <div class="témoignages">
    <h3><u>Témoignages de clientes</u></h3>

    <h4>Ephraim MOREAU:</h4>
    <blockquote>

      <pre>"Je suis totalement satisfaite de mes achats chez Hereka Design ! 
        Les vêtements sont de grande qualité et correspondent parfaitement à mes attentes. Je recommande vivement cette boutique."
      </pre>
    </blockquote>

    <h4>Hyacinthe LABIERRE:</h4>
    <blockquote>

      <pre>"J'ai été impressionné par le service client exceptionnel de Hereka Design.
         Ils ont été attentifs à mes besoins et m'ont aidé à choisir les meilleurs articles pour moi.
          Je suis très heureux de mes achats."

            </pre>
    </blockquote>



    <h4>Eslie DUCON:</h4>
    <blockquote>

      <pre>
                "J'adore l'attention aux détails et la qualité supérieure des tissus utilisés par Hereka Design. 
                Leurs vêtements sont confortables, durables et très tendance. 
                Je reçois toujours des compliments lorsque je les porte."

            </pre>
    </blockquote>

  </div>

  <div class="entretien">
    <h3><u>Entretien des vêtements</u></h3>
    <p>Conseils d'entretien pour garder vos vêtements en bon état.</p>
  </div>
  </section>

  <script src="jquery-3.6.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

</body>

</html>
