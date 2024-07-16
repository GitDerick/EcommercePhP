<?php
$nom = "Derick";
// echo time();
setcookie('name', $nom, time() + (60));
echo $_COOKIE['name'];




?>
