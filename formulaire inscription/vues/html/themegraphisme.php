<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/header.css" />
    
</head>
<body>
    <?php
    require("header.html");
    require("menu.html");
   ?>
<h1>Le Graphisme</h1>
<p>je fais ci et ca en graphisme blabla</p>

<ul>domaine lié au graphiisme</ul>

<?php 
require("../../controleur/conbdd.php");
$sql= "SELECT name FROM domaine ";
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $data)
{
    echo "<li> $data[name] </li>";
    
}
?>

<!---<li><a href="photoshop.php">photoshop</a><li>-->

<?php
    require("footer.html");
    ?>
</body>



</html>
