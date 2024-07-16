<?php
if (isset($_GET['id'])) {
    include './includes/fonction.php';
    $id = $_GET['id'];
    deleteUser($id);
}


?>
