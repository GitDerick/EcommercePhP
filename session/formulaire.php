<?php
session_start();


if (isset($_POST['envoyer'])) {
    $textF = $_POST['textFormulaire'];
    $dateF = $_POST['dateFormulaire'];

    $_SESSION['textFormulaire'] = $textF;
    $_SESSION['dateFormulaire'] = $dateF;
    header('location: ./resultat.php');

}


?>



<form action="" method="post">
    <div>
        <input type="text" name="textFormulaire"><br><br>
        <input type="date" name="dateFormulaire"><br><br>
        <input type="submit" value="Envoyer" name="envoyer">
    </div>
</form>
