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
<h1>Photoshop</h1>

<p>je maitrise vraiment  bien Photoshop, la preuve</p>
<ul>compétence</ul>


<?php 
require("../../controleur/conbdd.php");
$sql= "SELECT competence.name,niveau FROM competence,domaine WHERE domaine=domaine.id and domaine.name='photoshop'";
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
 
 foreach($result as $data)
{
    echo "<li> $data[name] ,  $data[niveau] </li>";
    
}


    
    require("footer.html");
    ?>
</body>



</html>
