<?php
include('Connexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrer les avions</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<form action=" " method="GET">
   <label for="recherche">Rechercher un avion : </label> 
   <input type="text" name="recherche" id="recherche">
   <input type="submit" value="Rechercher"><br><br>     
</form>

  <table>
         <tr> 
  <th> N° </th>   
<th>Matricule</th>
<th>Designation commercialle</th>
<th>Nom commercial</th>
<th>Capacite</th>
<th>Image</th>
        </tr>  
        <?php
        //Exécution de la requête
        
        if(isset($_GET['recherche'])){
        $recherche = mysqli_real_escape_string($connexion, $_GET['recherche']);
        $requete='SELECT Mat, a.Des_Com, img, Nom_Com,Capacite
                                          FROM avions AS a INNER JOIN modeles AS m
                                         ON m.Des_Com=a.Des_Com WHERE a.Des_Com like "%'.$recherche.'%"';}
        else{
        $requete='SELECT Mat, a.Des_Com, img, Nom_Com,Capacite 
                                 FROM avions AS a INNER JOIN modeles AS m
                                         ON m.Des_Com=a.Des_Com';
        }
       //Affichage des données issues de requête dans le tableau.
       $resultat=mysqli_query($connexion,$requete);
       if (!$resultat) 
       {
        die("Erreur SQL : " . mysqli_error($connexion));
       }
       echo 'Il y a '. mysqli_num_rows($resultat) . ' avion(s) qui correspond à votre recherche : </br>';
       $i=0;

  while($donnees=mysqli_fetch_assoc($resultat))
{
    echo '<tr>'; 
    echo '<td>'.++$i.'</td>'; 
    echo '<td>'.$donnees['Mat'].'</td>';   
    echo '<td>'.$donnees['Des_Com'].'</td>';
    echo '<td>'.$donnees['Nom_Com'].'</td>';
    echo '<td>'.$donnees['Capacite'].'</td>';
    echo '<td><img class="image" src="data:image/jpeg;base64,'. base64_encode($donnees['img'] ).'"></td>';
    echo '</tr>';  
    }
  ?>


</table> 
</body>
</html>
