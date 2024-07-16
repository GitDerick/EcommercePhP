<?php
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}
function connexionDB()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "achatvente";
    $port = 3306;

    $connexion = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $port);
    if (!$connexion) {
        die("echec de connexion avec la base de donnee" . mysqli_connect_error());
    }
    return $connexion;
}



/**
 * Ajouter un produit dans la base de donnee
 *
 * @param string $nom
 * @param float $prix
 * @param int $nom_de_produit
 * @param datetime $date_affiche
 * @param string $description
 * @return void
 */
function ajouterCreation($nom, $prix, $nombre_de_produit, $date_affiche, $description = "", $chemin = "")
{
    $connexion = connexionDB();
    $sql = "INSERT INTO creation(nom,prix,nombre_de_produit,date_affiche,description)
    values(?,?,?,?,?)";
    $stmt = $connexion->prepare($sql);
    // string s, int i, float | double d, bool b
    $stmt->bind_param("sdiss", $nom, $prix, $nombre_de_produit, $date_affiche, $description);
    $resultat = $stmt->execute();
    $id_creation = $connexion->insert_id;

    if ($resultat) {
        if (!empty($chemin)) {
            enregistrerImage($id_creation, $chemin);
        }
        header('Location: ./gestionCreation.php');

    } else {
        echo "Erreur d'ajout";
    }
    $stmt->close();
    $connexion->close();

}


function getCreations()
{
    $conn = connexionDB();
    $sql = 'SELECT p.id, p.nom, p.date_affiche, p.description, p.prix, p.nombre_de_produit, i.chemin FROM creation p join image i on p.id=i.id';
    //$sql = 'SELECT * from Creation';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $creations = array();

    foreach ($resultats as $creation) {
        $creations[] = $creation;
    }
    return $creations;
}

function deleteCreationById($id)
{
    $conn = connexionDB();
    $sql = "DELETE FROM creation where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        header('Location: ./gestionCreation.php');
    } else {
        echo 'Une erreur est survenue';
    }

}

function getCommandeCreationById($id)
{
    $conn = connexionDB();
    $sql = "SELECT * from commandeproduit where id_commande = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultat = $stmt->get_result();

    $commandes = array();
    foreach ($resultat as $commande) {
        $commandes[] = $commande;
    }
    return $commandes;
}

function getCreationById($id)
{
    $conn = connexionDB();
    $sql = 'SELECT p.id, p.nom, p.date_affiche, p.description, p.prix, p.nombre_de_produit, i.chemin FROM creation p join image i on p.id=i.id where p.id = ?';
    //$sql = 'SELECT * FROM Creation where id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $creation = $resultat->fetch_assoc();
    return $creation;
}

function modifierCreation($id, $nom, $prix, $nombre_de_produit, $date_affiche, $description)
{
    $conn = connexionDB();
    $sql = "UPDATE creation set nom =? ,prix =?, nombre_de_produit=?, date_affiche =?, description=? where id =?";
    $stmt = $conn->prepare($sql);
    // string s, int i, float | double d, bool b
    $stmt->bind_param("sdissi", $nom, $prix, $nombre_de_produit, $date_affiche, $description, $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        header('Location: ./gestionCreation.php');
    } else {
        echo "Erreur lors de la modification";
    }
    $stmt->close();
    $conn->close();

}

function ajoutPanier($id, $quantite, $panier = false)
{

    $_SESSION['panier'][$id] = $quantite;
    if ($panier) {
        header("Location: ./panier.php");
    } else {
        header("Location: ./gestionCreation.php");
    }
}

function countPanier()
{
    $cpt = count($_SESSION['panier']);
    return $cpt;
}
function getPaniers()
{
    return $_SESSION['panier'];
}

function supprimerPanier($id)
{
    unset($_SESSION['panier'][$id]);
    header('Location: ./panier.php');
}

function enregistrerImage($id_creation, $chemin)
{
    $connexion = connexionDB();
    $sql = "INSERT INTO image(id_creation,chemin)values(?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('is', $id_creation, $chemin);
    $resultat = $stmt->execute();
    if ($resultat) {
        header("location:./gestionCreation.php");
    } else {
        echo "Une erreur s'est produite";
    }
}

/*function insererCreation($id_creation, $chemin)
{
    $connexion = connexionDB();
    $sql = "INSERT INTO Creation(id_creation,chemin)values(?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('is', $id, $chemin);
    $resultat = $stmt->execute();
    if ($resultat) {
        header("location:./gestionCreation.php");
    } else {
        echo "Une erreur s'est produite";
    }
}*/

function updateCreation($id_creation, $chemin)
{
    $connexion = connexionDB();
    $sql = "UPDATE Creation set chemin = ? where id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('is', $chemin, $id_creation);
    $resultat = $stmt->execute();
    if ($resultat) {
        var_dump($id_creation);
        //header("location:./gestionCreation.php");
    } else {
        echo "Une erreur s'est produite";
    }
    $stmt->close();
    $connexion->close();
}


function getAllUser()
{
    $connexion = connexionDB();
    $sql = "SELECT id, nom, prenom, sexe, date_de_naissance, email, mot_de_passe, telephone, date_creation from utilisateur";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $users = array();
    foreach ($resultat as $user) {
        $users[] = $user;
    }
    return $users;
}



function getUserById($id)
{
    $connexion = connexionDB();
    $sql = "SELECT id, nom, prenom, sexe, date_de_naissance, email, mot_de_passe, telephone from utilisateur where id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultat = $stmt->get_result();

    $user = $resultat->fetch_assoc();
    return $user;
}


function UpdateUser($id, $update_data)
{
    $connexion = connexionDB();
    $sql = "UPDATE utilisateur set nom=?, prenom=?, sexe=?, email=?, date_de_naissance=?, telephone=? where id=?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param(
        'ssssiii', $update_data['nom'],
        $update_data['prenom'],
        $update_data['sexe'],
        $update_data['email'],
        $update_data['date_de_naissance'],
        $update_data['telephone'],
        $id
    );
    $Update = $stmt->execute();
    if ($Update) {
        header('location: ./gestionUtilisateur.php');
    }
    $stmt->close();
    $connexion->close();

    return $Update;
}



function SaveUser($nom, $prenom, $sexe, $date_de_naissance, $email, $mot_de_passe, $telephone)
{
    $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $connexion = connexionDB();
    $sql = "INSERT into utilisateur set nom=?, prenom=?, sexe=?, email=?, date_de_naissance=?, telephone=?, mot_de_passe=? values(?,?,?,?,?,?,?)";
    $client = "client";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('ssssiiss', $nom, $prenom, $sexe, $email, $date_de_naissance, $telephone, $mot_de_passe, $client);
    $result = $stmt->execute();
    if ($result) {
        header('location: ./gestionUtilisateur.php');
    } else {
        echo "Problème lors de l'enregistrement";
    }

}


function deleteUser($id)
{
    $connexion = connexionDB();
    $sql = "DELETE from utilisateur where id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $delete = $stmt->execute();
    if ($delete) {
        header('location: ./gestionUtilisateur.php');
    } else {
        echo "Erreur";
    }
}

function datetime()
{
    return $date_commande = date("Y-m-d h:m:s");

}

function ajouterCommande($totals, $id_utilisateur)
{
    $connexion = connexionDB();
    $sql = "INSERT INTO commande(total,date_commande,id_user)values(?,?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('dsi', $totals, $date_commande, $id_utilisateur);
    $resultat = $stmt->execute();
    if ($resultat) {
        $id_commande = $connexion->insert_id;
        $monPanier = getPaniers();
        foreach ($monPanier as $id => $nombre_de_produit) {
            ajouterCommandeProduit($id_commande, $id, $nombre_de_produit);
        }
        header("Location: ./success.html");
    }
}

function ajouterCommandeProduit($id_commande, $id, $nombre_de_produit)
{
    $connexion = connexionDB();
    $sql = "INSERT INTO commandeproduit(id_commande,id,nombre_de_produit)values(?,?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('iii', $id_commande, $id, $nombre_de_produit);
    $resultat = $stmt->execute();
    if ($resultat) {
        $id_commande = $connexion->insert_id;
    }
}


function getAllCommande()
{
    $connexion = connexionDB();
    $sql = "SELECT * from Commande";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $resultat = $stmt->get_result();

    $commandes = array();
    foreach ($resultat as $commande) {
        $commandes[] = $commande;
    }
    return $commandes;
}

function getUtilisateurById($id)
{
    $connexion = connexionDB();
    $sql = "SELECT * from utilisateur where id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultat = $stmt->get_result();

    $utilisateur = $resultat->fetch_assoc();
    return $utilisateur;
}

?>
