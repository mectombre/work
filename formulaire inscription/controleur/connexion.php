<?php  
$sql="SELECT login,mdp FROM utilisateur WHERE login='$log' and mdp='$mdp'" ;
$sth =$base->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
//echo $result["login"];
//var_dump($result);
if (isset($result[0]["login"])&& isset($result[0]["mdp"]) ){
    echo "Vous venez de vous connecter a la base de donnée";
    header("Location:../vues/html/themegraphisme.php"); 
} else {
    echo "connexion échouer, inscrivez-vous ";
    
}
?>