<?php require_once('../../private/shared/initialise.php'); ?>

<!doctype html>

<html lang="en">
  <head>
    <title>Tournaments</title>
    <style>
        table{
            border-collapse:collapse;
        }
        
        table, th, td {
            border: 1px solid black;
            padding:5px
        }
        
    </style>
  </head>

  <body>

    <h1>Tournaments</h1>
    
    <table>
        <tr>
            <th>Tournament ID</th>
            <th>Signup Date</th>         
        </tr>
        <?php 
            $query = "SELECT * FROM tournaments";
            $result_set = mysqli_query($connection, $query);
    
            while($tournaments = mysqli_fetch_assoc($result_set)){
                echo "<tr>";
                    echo "<td>".$tournaments["id"]."</td>";
                    echo "<td>".$tounrnaments["signup"]."</td>";
                    echo "<td> <a href=tournamentsEdit.php?id=".$tournmanets["id"].">Edit</td>";
                    //echo "<td> <a href="?delete=$tournamnets["id"]">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <a href=tournamentCreate.php]>Create
    
  </body>
</html>

<?php 
    mysqli_free_result($result_set);
    mysqli_close($connection);
?>
