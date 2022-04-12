<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables de vérité</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Comparaison de tables de vérité</h1>    
    <main>        
        <section>            
            <h2>Première partie de la démonstration</h2>
            <table>
                <th>p</th>
                <th>q</th>
                <th>r</th>
                <th>p + r</th>
                <th>q.(p+r)</th>
                <?php            
                $tableau = [0, 1]; 
             foreach ($tableau as $r) {
                 foreach($tableau as $p){
                    foreach($tableau as $q){
                        $u = $p || $r;

                        echo '<tr>';

                        echo '<td>';
                        echo $p;
                        echo '</td>';

                        echo '<td>';
                        echo $q;
                        echo '</td>';

                        echo '<td>';
                        echo $r;
                        echo '</td>';



                        echo '<td>';
                        if ($u){
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                        echo '</td>';

                        echo '<td>';
                        if ($q && $u){
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                        echo '</td>';

                        echo '</tr>'; 
                    }                       
                }    
            } 
            ?>
            </table>
        </section>

        <section>
            <h2>Seconde partie de la démonstration</h2>
            <table>
                <th>p</th>
                <th>q</th>  
                <th>r</th>         
                <th>q.p</th>
                <th>q.r</th>
                <th>(q.p) + (q.r)</th>
                <?php     
                foreach($tableau as $r) {
                foreach($tableau as $p){
                    foreach($tableau as $q){           
                              $u = $q && $p;
                              $v =  $q && $r;
                        echo '<tr>';

                        echo '<td>';
                        echo $p;
                        echo '</td>';

                        echo '<td>';
                        echo $q;
                        echo '</td>';

                        echo '<td>';
                        echo $r;
                        echo '</td>';

                        echo '<td>';                      
                        if ( $u ){
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                        echo '</td>';     
                        

                        echo '<td>';                      
                        if ( $v){
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                        echo '</td>'; 

                        echo '<td>';                      
                        if ($u || $v ){
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                        echo '</td>'; 
                    }                       
                }     
            }
                ?>
            </table>
        </section>
    </main>
        
        


        
        
</body>
</html>