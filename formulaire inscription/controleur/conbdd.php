<?php
$host = 'localhost' ;
$dbname = 'devweb2' ;
$username = 'root' ;
$password = '' ;
try {
$base = new PDO("mysql:host=$host; dbname=$dbname", $username, $password) ;
//echo "Connecté à $dbname sur $host avec succès." ;
} catch (PDOException $e) {
die("Impossible de se connecter à la base de données $dbname :".
$e->getMessage()) ;
}
?>