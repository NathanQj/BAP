<?php
$destinataire = "nathan.qjm@gmail.com";
$message = "Titre et ID de la vidéo : ".$_GET['id_video']." // Motif du signalement :  ".$_GET['report']." // Signalement effectué par : ".$_SESSION['username'];
echo "Merci pour le signalement, bonne visite sur Custorial.com";
mail($destinataire, "Signalement de vidéo", $message);
?>