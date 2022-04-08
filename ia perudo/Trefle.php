

<?php
require_once("Joueur.php");
class Trefle extends Joueur {
    
    public function historique($coupsJoues,$nbDesParJoueur){
        //echo "lecture historique en cours...";
    }


// Fonction crédibilité qui vérifie si ce qu'a dit le joueur précédent est crédible
// ---------------------------------------------------------------------------------

    function credibilite($val,$qte, $lesDes){
        $total=0;
    
        for($i=0;$i<$this->nbDes;$i++ ){
            if($val==$this->mesDes[$i]){
                $total++;
            }
        }
        
        if(($qte+$total)>=(35*$lesDes)/100){
            $credibilite=false;
        }else{
            $credibilite=true;
        }
                       
        return  $credibilite;                    
                 
    }

// Fonction crédibilité qui vérifie si ce qu'a dit le joueur précédent est crédible
// ---------------------------------------------------------------------------------
    
    public function pacobilite($val,$qte, $lesDes){
        $total=0;
    
        for($i=0;$i<$this->nbDes;$i++ ){
            if($val==$this->mesDes[$i]){
                $total++;
            }
        }
        
        if(($qte+$total)>=(20*$lesDes)/100){
            $credibilite=false;
        }else{
            $credibilite=true;
        }
                       
        return  $credibilite;                    
                 
    }


// Fonction cpt paco qui compte le nombre de pacos que nous avons sous notre goblet
// ---------------------------------------------------------------------------------



    public function __construct ($nom){
        parent::__construct("Trefle");
    }
    
    public function evaluer($qte, $val, $palifico, $nbDes) {


    
        
/* ---------------------------------------------------------- Phase 1 -------------------------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------------------------------- */


        // On compte le nombre de paco que nous avons sous notre gobelet 
        if($nbDes<=20 && $nbDes>15 ){
           
            $nbpaco=0;
            for($i=0;$i<$this->nbDes;$i++ ){
                if($this->mesDes[$i]==1){
                $nbpaco++;
            }
            }
            
            //                                   ----------- Si on est les premiers à jouer   --------------

            // On vérifie si nous sommes les premiers à jouer 
            if ($val==0 && $qte==0){
                
                // Pour chacun de nos dé on rentre sa valeur dans le tableau
                $tab = [0,0,0,0,0,0,0];
            
                //  On parcourt nos dés et on ajoute 1 dans le tableau dès qu'on a sa valeur
                for ($i=0;$i<$this->nbDes;$i++){
                    $tab [ $this->mesDes[$i] ]++ ;
                }
                
                $Qmax=0;
                $value=0;
                // On cherche la quantité et la valeur maximale correspondante dans le tableau
                for($i=0;$i<7;$i++){
                    if($tab[$i]>=$Qmax){
                        $Qmax=$tab[$i];
                        $value=$i;
                    }

                }
            //    On multiplie la quantité par 2 car nous sommes en phase 1 
            // !!!!!  attention si notre quantité est déjà égale à 5 on ne peut pas la doubler
                
                $qte=$Qmax*2;
                $val =$value;

                if($val==1){
                    $qte=rand(1,5);
                    $val =rand(2,6);
                    return [$qte,$val];
                }else
                if ($this->credibilite($val,$qte, $nbDes)){
                    return [$qte,$val];
                }else{
                    $qte=$Qmax;
                    $val =$value;
                    return [$qte,$val];
                }

               
                
    
// -------------------------------------- Si l'annonce précédente est donnée en paco et que la quantité n'est pas réaliste ----------------------------------------

            }elseif($val==1 && $qte!=0 && !$this->pacobilite($val,$qte,$nbDes)){
                // on dit tu mens
               
                $val;
                $qte=-1;
                return [$qte,$val]; 
                
            
 // ---------------------------------- Si l'annonce précédente est donnée en paco et la quantité donnée est réaliste ----------------------------------------
 
 
            }elseif($val==1 && $qte!=0 && $this->pacobilite($val,$qte,$nbDes)){
                                
                $qte=$qte+1;
                // On vérifie si une fois que nous avons joué, notre probabilité est bonne
                if ($this->pacobilite($val,$qte,$nbDes)){
                     // si oui on continue en paco 
                    $val;
                    $qte=$qte+1;
                    return [$qte,$val]; 
                    // sinon on regarde si on a au moins 1 pacos 
                }elseif(!$this->pacobilite($val,$qte,$nbDes) && $nbpaco>=1){
                    // Si la probabilité n'est pas bonne mais que l'on a au moins 1 paco
                    $val;
                    $qte=$qte+1;
                    return [$qte,$val]; 
                }else{
                     // si la probabilité n'est pas bonne et que l'on a pas de paco on annonce: " tu mens "
                    $val;
                    $qte=-1;
                    return [$qte,$val]; 
                }
                
                   // Si une personne à joué avant -> quantité différentes de 0, que nous ne sommes pas en pacos et que ce qui a été dit est crédible alors:
             }elseif($val!=1 && $qte!=0 && $this->credibilite($val,$qte, $nbDes)){
                   
                    $qte=$qte+1;
                    return [$qte,$val]; 
                   // Si une personne à joué avant -> quantité différentes de 0, que nous ne sommes pas en pacos et que ce qui a été dit n'est pas crédible alors: 
             }elseif($val!=1 && $qte!=0 && !$this->credibilite($val,$qte, $nbDes)){
                if($nbpaco>=2){
                    $val=1;
                    $qte=ceil($qte/2);
        
                    return [$qte,$val]; 
        
                }else{
                    $val;
                    $qte=-1;
                    return [$qte,$val]; 
                }
             }
}





// -----------------------------------------------------    Phase 2   ---------------------------------------------------------



    if($nbDes<=15 && $nbDes>0){

        $nbpaco=0;
        for($i=0;$i<$this->nbDes;$i++ ){
            if($this->mesDes[$i]==1){
            $nbpaco++;
            }
        } 
    
    //                                   ----------- Si on est les premiers à jouer   --------------

    // On vérifie si nous sommes les premiers à jouer 
    if ($val==0 && $qte==0){
        
        // Pour chacun de nos dé on rentre sa valeur dans le tableau
        $tab = [0,0,0,0,0,0,0];
    
        //  On parcourt nos dés et on ajoute 1 dans le tableau dès qu'on a sa valeur
        for ($i=0;$i<$this->nbDes;$i++){
            $tab [ $this->mesDes[$i] ]++ ;
        }
        
        $Qmax=0;
        $Value=0;

        for($i=0;$i<7;$i++){
            if($tab[$i]>=$Qmax){
                $Qmax=$tab[$i];
                $value=$i;
            }

        }
 
        $qte=$Qmax+1;
        $val =$value;
        return [$qte,$val];

// ----------------------------------------------- Si l'annonce précédente est  crédible ----------------------------------------

}elseif($val==1 && $qte!=0 && !$this->pacobilite($val,$qte,$nbDes)){
    // on dit tu mens
   
    $val;
    $qte=-1;
    return [$qte,$val]; 
    

// ---------------------------------- Si l'annonce précédente est donnée en paco et la quantité donnée est réaliste ----------------------------------------


}elseif($val==1 && $qte!=0 && $this->pacobilite($val,$qte,$nbDes)){
                    
    $qte=$qte+1;
    // On vérifie si une fois que nous avons joué, notre probabilité est bonne
    if ($this->pacobilite($val,$qte,$nbDes)){
         // si oui on continue en paco 
        $val;
        $qte=$qte+1;
        return [$qte,$val]; 
        // sinon on regarde si on a au moins 1 pacos 
    }elseif(!$this->pacobilite($val,$qte,$nbDes) && $nbpaco>=1){
        // Si la probabilité n'est pas bonne mais que l'on a au moins 1 paco
        $val;
        $qte=$qte+1;
        return [$qte,$val]; 
    }else{
         // si la probabilité n'est pas bonne et que l'on a pas de paco on annonce: " tu mens "
        $val;
        $qte=-1;
        return [$qte,$val]; 
    }
    
       // Si une personne à joué avant -> quantité différentes de 0, que nous ne sommes pas en pacos et que ce qui a été dit est crédible alors:
 }elseif($val!=1 && $qte!=0 && $this->credibilite($val,$qte, $nbDes)){
       
        $qte=$qte+1;
        return [$qte,$val]; 
       // Si une personne à joué avant -> quantité différentes de 0, que nous ne sommes pas en pacos et que ce qui a été dit n'est pas crédible alors: 
 }elseif($palifico){
    if($this->credibilite($val,$qte, $nbDes)){
    $qte+=1;
    return [$qte,$val]; }
    else{
        $val;
        $qte=-1;
        return [$qte,$val]; 
    }
 }
 
 elseif($val!=1  && $qte!=0 && !$this->credibilite($val,$qte, $nbDes)){
    if($nbpaco>=2){
        $val=1;
        $qte=ceil($qte/2);

        return [$qte,$val]; 

    }else{
        $val;
        $qte=-1;
        return [$qte,$val]; 
    }
 }
}

if($this->mesDes==1){
    $qte=1;
    $val=rand(1,6);
    return [$qte,$val]; 
}

// // -------------------------------------------------------  Phase 3 -----------------------------------------------



// if($nbDes<=10 && $nbDes>5){

//     $nbpaco=0;
//     for($i=0;$i<$this->nbDes;$i++ ){
//         if($this->mesDes[$i]==1){
//            $nbpaco++;
//         }
//     } 
    
//     //                                   ----------- Si on est les premiers à jouer   --------------

//     // On vérifie si nous sommes les premiers à jouer 
//     if ($val==0 && $qte==0){
        
//         // Pour chacun de nos dé on rentre sa valeur dans le tableau
//         $tab = [0,0,0,0,0,0,0];
    
//         //  On parcourt nos dés et on ajoute 1 dans le tableau dès qu'on a sa valeur
//         for ($i=0;$i<$this->nbDes;$i++){
            
//            $tab [ $this->mesDes[$i] ]++ ;
//         }
        
//         $Qmax=0;
//         $Value=0;

//         for($i=0;$i<7;$i++){
//             if($tab[$i]>=$Qmax){
//                 $Qmax=$tab[$i];
//                 $value=$i;
//             }

//         }
    
//         $qte=$Qmax*2;
//         $val =$value;
//         return [$qte,$val];

// // ----------------------------------------------- Si l'annonce précédente est  crédible ----------------------------------------

//     }elseif($this->credibilite($val,$qte,$nbDes)){
//         // Si les valeurs données par les autres joueurs semblent crédibles, on joue quantité + 1
//         $val;
//         $qte=$qte+1;
//         return [$qte,$val]; 
        
    
// // ----------------------------------------------- Si l'annonce précédente n'est pas crédible ----------------------------------                           
//     }else{
//           // Si les valeurs données par les autres joueurs ne semblent pas crédibles, on passe en paco 
//         if($nbpaco>=1 && $val!=1){
//             $val=1;
//             $qte=ceil($qte/2);

//             return [$qte,$val]; 

//         }else{
//             $val;
//             $qte=-1;
//             echo "objection votre honneur";
//             return [$qte,$val]; 
//         }
        
                    
//      }
// }



// // -------------------------------------------------------  Phase 4 -----------------------------------------------



// if($nbDes<=5 && $nbDes>0){

//     $nbpaco=0;
//     for($i=0;$i<$this->nbDes;$i++ ){
//         if($this->mesDes[$i]==1){
//            $nbpaco++;
//         }
//     } 
    
//     //                                   ----------- Si on est les premiers à jouer   --------------

//     // On vérifie si nous sommes les premiers à jouer 
//     if ($val==0 && $qte==0){
        
//         // Pour chacun de nos dé on rentre sa valeur dans le tableau
//         $tab = [0,0,0,0,0,0,0];
    
//         //  On parcourt nos dés et on ajoute 1 dans le tableau dès qu'on a sa valeur
//         for ($i=0;$i<$this->nbDes;$i++){
            
//               $tab [ $this->mesDes[$i] ]++ ;
//         }
        
//         $Qmax=0;
//         $Value=0;

//         for($i=0;$i<7;$i++){
//             if($tab[$i]>=$Qmax){
//                 $Qmax=$tab[$i];
//                 $value=$i;
//             }

//         }
      
//         $qte=$Qmax*2;
//         $val =$value;
//         return [$qte,$val];

// // ----------------------------------------------- Si l'annonce précédente est  crédible ----------------------------------------

//     }elseif($this->credibilite($val,$qte,$nbDes)){
//         // Si les valeurs données par les autres joueurs semblent crédibles, on joue quantité + 1
//         $val;
//         $qte=$qte+1;
//         return [$qte,$val]; 
        
    
// // ----------------------------------------------- Si l'annonce précédente n'est pas crédible ----------------------------------                           
//     }else{
//           // Si les valeurs données par les autres joueurs ne semblent pas crédibles, on passe en paco 
//         if($nbpaco>=1 && $val!=1){
//             $val=1;
//             $qte=ceil($qte/2);

//             return [$qte,$val]; 

//         }else{
//             $val;
//             $qte=-1;
//             echo "objection votre honneur";
//             return [$qte,$val]; 
//         }
        
                    
//      }
// }





}

}



?>




















