<?php

session_start();

// $mysqli =  new mysqli( 'localhost', 'root','crud','')
//  or die (mysqli_error($mysqli)); 
$user="root";
$mdp="";
$bd="crud";
$serveur="localhost";

$link = mysqli_connect($serveur,$user,$mdp,$bd);
if ($link)
{
     //echo "connexion etablit";
    
}
else
{
    die (mysqli_connect_error());
}
//bout de code qui permet d'afficher le contenu de la Base de donne a l'ecran
if (isset ($_POST['save'])) 
{
    $name = $_POST['nom'];
    $location = $_POST['location'];
    $link ->query("INSERT INTO data (name,location) VALUES ('$name','$location')") or
            die ($link -> error);
        $_SESSION['message'] = "Enregistrement reussit avec succes";
        $_SESSION['msg_type'] = "success";

    header ("location: index.php");    
}

// bout de code qui permet de supprimer les lignes dans la base de donnee
if (isset ($_GET['delete']))
{
    $id = $_GET['delete'];
    $link -> query("DELETE FROM data WHERE id= $id") or
    die ($link -> error);    
    $_SESSION['message'] = "champ supprimer avec succes";
    $_SESSION['msg_type'] = "danger";

    header ("location: index.php");  
}
//bout de code qui permet d'editer une ligne dans le tableau et dans la base de donnee
if (isset ($_GET['edit']))
{
    $id = $_GET['edit'];
    $resultat= $link->query("SELECT * FROM data WHERE id= $id ")
    or die ($link ->error);
    
    // if (   count(Countable|array $link, int $mode = COUNT_NORMAL)== 1)               //probleme sur cette ligne
    if (count ($resultat))
    {
        $row = $resultat ->fetch_array();
        $name = $row ['name'];
        $location = $row ['location'];
    }
}
?>