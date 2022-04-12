<html>
<body>

<?php
$a = 7;
$b =3;
$c = $a+2*$b;
$a =1;
$c = $b-$a;
echo " $a.$b.$c ";

$a = 2;
$b =8;
$c= $a + $b; 
$a = $b-$a;
$a = $c;
echo " <br> $a.$b.$c";

$a =5;
$b=2;
$b=$a;
$a=$b;
echo " <br> $a.$b.$c";

$a=5;
$b=2;
$a=$a+$b;
$b=$a-$b;
$a=$a-$b;
echo " <br> $a.$b";

$a=5;
$b=2;
$c=$a;
$a=$b;
$b=$c;
echo " <br> $a.$b <br>";

echo '<input type="text" name"ex6" /> ';
for($cpt=1;$cpt<6;$cpt++)
{echo "<br> Garlic gum is not funny $cpt ";}

$a=3;
$b=5;
$c=4;
if ($a<$b +$c )
{echo " <br> $a +$b +$c ";
}
else {
    echo " <br>$a +$b-$c";
}

$c= random_int(1,2);
echo "<br> $c ";
if ($c== 1){
    echo"tant mieux";
}else {
    echo"tant pis";
}

$b= random_int(1,2);
echo "<br> $b ";
switch($b) 
{case "1":
echo "tant mieux";
break;
case "2" :
echo "tant pis";
break;
default :
}

$b=rand(0,1);
$c=rand(0,1);
echo "<br>$b et $c ";
if ( ($b && $c ) || ( !$b && !$c )){
    echo "<br>c'est pénible non ?";
}
if ($b && !$c)
{echo "<br> bonne nouvelle"; }
if (!$b && $c)
{echo " <br>dommage mais ça pourrait etre pire";}

$a=rand();
if ($a ==1)
{echo " <br>vous avez une piece";}
else 
{echo " <br>vous avez $a pieces ";}

$a=rand(-10,10);
if ( $a>=0)
{echo "<br>il est positif<br>";}
else {echo "<br>il est negatif<br>";}

$a=rand(-10,10);
$b=rand(-10,10);
if (($a <0 && $b <0) || ($a >0 && $b >0))
{echo"le produit est positif";}
if (($a>0 && $b<0) || ($a<0 && $b>0))
{echo "le produit est negatif"; }
if (($a==0 && $b!=0) || ($a!=0 && $b ==0))
{echo " le produit est nul";}

$a=rand(1,10);
$b=rand(1,10);
$c=rand(1,10);
echo "<br>";
if (($a > $c && $c > $b) || ($a < $c && $c < $b))
{echo "$c est compris entre $a et $b";}
else {echo " $c n'est pas compris entre $a et $b";}

$a=rand(1,10);
$b=rand(1,10);
$c=rand(1,10);
$d=rand(1,10);
$e=rand(1,10);
$m= max($a,$b,$c,$d,$e );
echo "<br> val max $m";

$a=0;
for($i=1;$i<5;$i++)
{$a=$a+$i;}

$a=1;
for($i=0;$i<7;$i+=2)
{$a=$i-2*$a;}

for($i=1;$i<5;$i++)
{$a=rand(0,10);
echo "<br>$a";
if ($a<0){
    $a=$a+$i;
}
else
{$a=$i-$a;}
}

$b=0;
for($i=1;$i<6;$i++)
{$a=rand(0,10);
    echo " $a ";
    if($a>$b)
    {$b=$a;}   
}
echo "<br>$b<br>";

$b=0;
$c=20;
$d=0;
$moy =0;
for($i=1;$i<21;$i++)
{$a=rand(0,20);
if($a>$b)
    {$b=$a;}
if($a<$c)
{$c=$a;}
if($a>=10)
{$d++;}
$moy += $a;
}
$moy= $moy/20;
echo"la mailleur note est $b,  la pire note est $c,  la moyenne est de $moy et $d éleve ont la moyenne";

$a=0;
$b=1;
while($b<5)
{$a=$a*$b;
$b++;}

$a=0;
$b=1;
while($b<7)
{$a=$a+$b;
$b=$b*2;}

while($i<4)
$a=rand(0,10);
echo $a;
if ($a>0)
{$a +=$i;}
else 
{$a=$i-$a;
$i++;}

$a=0;
$b=0;
while($a != 12)
{$a=rand(10,20);
$b++;
}
echo "<br> il a fallu $b tentative pour que la variable soie égal a 12 <br>";

$i=0;
$a=1;
$moy =0;
$b = 0;
while($a !=0)
{$a=rand(0,20);
echo "$a;";
$moy += $a;
$i++;
if($a>$b)
{$b=$a;}
}
$moy= $moy/$i;
echo" le plus grand nombre tiré est $b,  et la moy des val saisie est de $moy <br>";

$tableau = ['janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre'];

$tableau2 =array('janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');

for($i=1;$i<count($tableau)+1;$i++)
{$j=$i-1;
echo " mois $i : $tableau[$j] ,";}
echo"<br>";
for($i=1;$i<count($tableau2)+1;$i++)
{$j=$i-1;
echo " mois $i : $tableau2[$j] ,";}

$tableau=['prénom'=>'Marcel','nom'=>'Dupont','date de naissance'=>'01,01,1970'];

$tableau2=array('prénom'=>'Marcel','nom'=>'dupont','date de naissance'=>'01,01,1970');
echo"<br>";
foreach($tableau as $t1 => $t2)
{echo " $t1 ; $t2  || ";}

function carré($a)
{
$a=$a*$a;
return $a;
}

function randomc(){
$b=rand(0,10);
$c = carré($b);
return $c;
}
$a = randomc();
echo "<br>carré : $a";

function factorielle($a){
    $i = 1;
    $c = 1;
    $cpt = $a+1;
while($cpt > $i){

$c = $c*$i;
$i++;
}
return $c;
}
function randomf(){
$b=rand(0,10);
$c=factorielle($b);
return $c;
}

$a = randomf();
echo "<br>factorielle : $a";
echo "<br>";


function addtabl($tabl){
$s = $tabl[0];
for($i=1;$i<count($tabl);$i++){
    $s = $s + $tabl[$i];
    }
    return $s;
}

function randt(){
$b=rand(1,10);
$tabl =[];
for($i=0;$i<$b;$i++){
    array_push($tabl,$i);
}
return $tabl;
}

$a= randt();
for($i=0;$i<count($a);$i++)
{
echo "$a[$i] ,";}

$b=addtabl($a);
echo "<br>$b";


?> 

<form method="post" action="td1.php">
nom : <input type="texte" name="nom"/>
prénom : <input type=" texte" name="prenom"/>
<input type="submit" value="submit"/>
</form>

<?php
$a = ($_POST['nom']);
$b = ($_POST['prenom']);
echo "<br>bonjour $b $a <br>";
?>

<form method="get" action="td1.php">
nom : <input type="texte" name="nom2"/>
prénom : <input type=" texte" name="prenom2"/>
<input type="submit" value="submit"/>
</form>

<form action="?nom2=max&prenom2=des" method="get">
<input type="submit" value="submit"/>
</form>

<?php
$a = ($_GET['nom2']);
$b = ($_GET['prenom2']);
echo "<br>bonjour $b $a ";
?>

<form action="td1.php" method="post">
<select name="listed" id="jour">
<option value="lundi">lundi</option>
<option value="mardi">mardi</option>
<option value="mercredi">mercredi</option>
<option value="jeudi">jeudi</option>
<option value="vendredi">vendredi</option>
<option value="samedi">samedi</option>
<option value="dimanche" selected>dimanche</option>
</select>
<input type="submit" value="submit"/>
</form>

<?php
$a = ($_POST['listed']);
echo "<br>aujourd'hui on est  $a ";
?>

<form action="td1.php" method="post">
<input type="checkbox" name="bonbon[]" value="bonbon1" id="bonbon1">
<label for="bonbon1">bonbon1</label>
<input type="checkbox" name="bonbon[]" value="bonbon2" id="bonbon2">
<label for="bonbon2">bonbon2</label>
<input type="checkbox" name="bonbon[]" value="bonbon3" id="bonbon3">
<label for="bonbon3">bonbon3</label>
<input type="submit" value="submit"/>
</form>

<?php
echo " <br> bonbon : ";
foreach($_POST['bonbon']as $bonbon)
echo "$bonbon";
?>

</body>
</html>
