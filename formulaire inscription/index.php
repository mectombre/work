<?php
$uri = $_SERVER['REQUEST_URI'];
$mvc =["controleur","modeles","vues"];
$pvue = ["html","medias","styles"];

$nomp = ["formulaire" => "./modeles/formulaire.php",
"acceuil" =>"./vues/html/acceuil.php",
"graphisme" =>"./vues/html/themegraphisme.php" ,
"photoshop" =>"./vues/html/photoshop.php"];

require("../controleur/conbdd.php");

//echo "<br>";
//echo $uri;

$expluri = explode("/",$uri);
//echo "<br>";
//var_dump($expluri);

//ajout de variable suivant la bdd
    $dom = [];

    $sql= "SELECT name FROM domaine ";
    $sth =$base->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $data)
    {
        array_push($dom,$data);
        
    }
    //echo "<br>";
    //var_dump($dom);

    $theme = [];
    $sql2= "SELECT name FROM themes ";

    $sth =$base->prepare($sql2);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $data)
    {
        array_push($theme,$data); 
    }
    //echo "<br>";
    //var_dump($theme);

//


function changeUrl() {
    if($expluri[1] !== "devweb2" ){
        for ($i=0;$i< count($nomp);$i++)
        {
            if ( $nomp[$i]= $expluri[1])
            {
            require("localhost/devweb2/" . $nomp[$expluri[1]]);
            }
       
        }
    }
}

?>