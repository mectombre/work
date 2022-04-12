<html>
<body>

<?php
$host = 'localhost' ;
$dbname = 'recettes' ;
$username = 'root' ;
$password = '' ;
try {
$base = new PDO("mysql:host=$host; dbname=$dbname", $username, $password) ;
echo "Connecté à $dbname sur $host avec succès." ;
} catch (PDOException $e) {
die("Impossible de se connecter à la base de données $dbname :".
$e->getMessage()) ;
}
?>
<h1>recettes anti-gaspi</h1>

<form action="recettes.php" method="post">
<select name="Nbpart" id="Nbpart">
<option>-</option>
<?php 
$sql= "SELECT DISTINCT Nbpart FROM recettes ORDER BY Nbpart ";
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $data)
{echo '<option>'.$data['Nbpart'].'</option>';}
?>
</select>

<select name="ingredients" id="ingredients">
<option  >-</option>
<?php 
$sql ="SELECT * FROM ingredients";
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $data)
{echo '<option>'.$data['nom'].'</option>';}
?>
</select>
<select name="categorie" id="categorie">
<option >-</option>
<?php 
$sql ="SELECT DISTINCT categorie FROM ingredients";
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $data){echo '<option>'.$data['categorie'].'</option>';}
?>

</select>
<input type="submit" value="submit"/>
<?php echo "$_POST[Nbpart],$_POST[ingredients],$_POST[categorie]<br>";
$ing = $_POST['ingredients'];
$part = $_POST['Nbpart'];
$cat = $_POST['categorie'];
/*
$sql="SELECT * FROM recettes WHERE Nbpart=$_POST[Nbpart]";
$sql="SELECT DISTINCT recettes.* FROM recettes , ingredients , quantites WHERE quantites.ingrédients=ingredients.id AND quantites.recettes = recettes.id AND ingredients.nom ='$ing'";
$sql = "SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE quantites.ingrédients=ingredients.id AND quantites.recettes = recettes.id AND ingredients.nom ='$ing'AND Nbpart='$part' ";
$sql = "SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id ";
$sql ="SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE recettes.Nbpart='$part' AND ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id ";
$sql = "SELECT DISTINCT recettes.* FROM quantites, recettes, ingredients WHERE  quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id AND ingredients.nom ='$ing' AND recettes.id IN (SELECT DISTINCT recettes.id FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id) ";

$sql = "SELECT recettes.* FROM recettes, ingredients, quantites WHERE recettes.Nbpart='$part' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id AND ingredients.nom ='$ing' AND recettes.id IN (SELECT DISTINCT recettes.id FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id)";*/

if($part=="-")
    {
    if($ing=="-")
        {
            if($cat=="-")
            {$sql="SELECT * FROM recettes";}
            else {
                $sql = "SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id ";
            }
            
        }
        else{
        if($cat=="-") {
            $sql="SELECT DISTINCT recettes.* FROM recettes , ingredients , quantites WHERE quantites.ingrédients=ingredients.id AND quantites.recettes = recettes.id AND ingredients.nom ='$ing'";
        }
        else{
            $sql = "SELECT DISTINCT recettes.* FROM quantites, recettes, ingredients WHERE  quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id AND ingredients.nom ='$ing' AND recettes.id IN (SELECT DISTINCT recettes.id FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id) ";
        }
    }
}else {
    if($ing=="-"){
        if($cat=="-")
            {$sql="SELECT * FROM recettes WHERE Nbpart=$_POST[Nbpart]";}
        
        else {
            $sql ="SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE recettes.Nbpart='$part' AND ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id ";
        }
    }
    else{ if($cat=="-"){
        $sql = "SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE quantites.ingrédients=ingredients.id AND quantites.recettes = recettes.id AND ingredients.nom ='$ing'AND Nbpart='$part' ";
        }
    else{
    $sql = "SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE recettes.Nbpart='$part' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id AND ingredients.nom ='$ing' AND recettes.id IN (SELECT DISTINCT recettes.id FROM recettes, ingredients, quantites WHERE ingredients.categorie='$cat' AND quantites.recettes = recettes.id AND quantites.ingrédients=ingredients.id)";
}
}
}
/*
if($_POST["Nbpart"]=='-')$part="NULL";
if($_POST["ingredients"]=='-')$ing="NULL";
if($_POST["categorie"]=='-')$cat="NULL";

sql2="SELECT DISTINCT recettes.* FROM recettes, ingredients, quantites WHERE quantites.ingrédient = ingredient.id AND quantites.recettes= recettes.id AND (ingredients.nom= :i OR :i is NULL) AND (recettes.Nbpart = :n OR :n IS NULL) AND recette.id IN ( SELECT recette.id FROM recettes,ingredients, quantites WHERE quantites.ingrédients=ingredients.id AND (ingredients.categorie= :c OR :c IS NULL
);
$sth =$base->prepare($sql2);
$sth -> bindvalue(":n",$part);
$sth -> bindvalue(":i",$ing);
$sth -> bindvalue(":c",$cat);
*/
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $data)
{echo $data['nom'];
    echo "<br>";
    $num=$data['id'];
    $sql2="SELECT ingredients.nom,quantites.quantites FROM ingredients,quantites WHERE quantites.recettes=$num  AND quantites.ingrédients=ingredients.id";
    $sth2 =$base->prepare($sql2);
$sth2->execute();
$result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
foreach($result2 as $data2){echo $data2['nom'];
    echo ", ";
    echo $data2['quantites'];
echo "<br>";}
echo  $data['etape'];
$image= $data['photo'];
$encodeimg= base64_encode($image);
echo "<br><img height='300px' src='data:image/jpeg;base64,{$encodeimg}'><br>";


}

?>

</form>
</html>