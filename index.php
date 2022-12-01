<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>PHP_CRUD</title>
</head>
<body>
    <!-- on inlus le processus de connection a la base de donnee -->

    <?php require_once 'process.php';?>
    
        <?php  

        if   (isset ($_SESSION['message'])); ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
                <?php
                     //session_start();
                     //$_SESSION['message'];
                     echo $_SESSION['message'];  //probleme sur cette ligne
                    
                     unset ($_SESSION['message']);
                    
                ?>
                </div> 

<div class="container">
         
    <?php
    $user="root";
    $mdp="";
    $bd="crud";
    $serveur="localhost";
    
    $link = mysqli_connect($serveur,$user,$mdp,$bd);
    if ($link)
    {
         //echo "connexion etablit";
         $result = $link -> query("SELECT * FROM data") ;   
    }
    else
    {
        die (mysqli_connect_error());
    }
     //pre_r($result);
     //pre_r($result -> fetch_assoc());
     ?>
        <!-- creation du tableau  -->
        

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name </th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>  
            </thead>  
            <!-- bout de code qui permet d'ajouter une nouvelle ligne dans le tableau a chaque fois q'une condition est verifier -->
    <?php
        while ($row = $result -> fetch_assoc()):?>
        <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['location'];?></td>
            <td>
                <a href="index.php?edit= <?php echo $row['id']; ?>"
                class="btn btn-info">Edit</a>
                <a href="process.php?delete= <?php echo $row['id']; ?>"
                class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endwhile ;?>
        </table>  
    </div> 

    <?php


     //insertion de la fonction qui permet de ranger les elements sous forme de tableau.
    function pre_r( $array)  

    {
        echo '<pre>';
        print_r($array);
        echo '</pre>'; 
    }

    ?>

<div class="row justify-content-center">
     <form action="process.php" method="POST">
        <div class= "form-group">
        <label>Name</label>
        <input type="text" name="nom"  class= "form-control" value="<?php echo $row['nom'] ;?>" placeholder="Enter your name"><br>
       </div>
       <div class="form-group">
        <label>Location</label>
        <input type="text" name="location"  class= "form-control" value="<?php echo $row['location'] ?>" placeholder="Enter your location"><br>
       </div>
       <div class="form-group">
        <button type ="submit" class="btn btn-primary" name="save"> SAVE </button>
        </div>
     </form>
</div>
</div>


    </body>
</html>