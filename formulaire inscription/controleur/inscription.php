<?php
$sql="SELECT login,mdp FROM utilisateur WHERE login='$log' and mdp='$mdp'" ;
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
//echo $result["login"];
//var_dump($result);
if (isset($result[0]["login"])&& isset($result[0]["mdp"]) ){
echo "vous etes déja inscrit";}
else {
    $sql="INSERT INTO utilisateur(login,mdp)VALUES('$log','$mdp')";
$sth =$base->prepare($sql);
$sth->execute();

}

?>