<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/classes/tournament.class.php');
?>

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
			<th>&nbsp;</th>
			<th>&nbsp;</th>			
        </tr>
        <?php 
            $query = "SELECT * FROM tournaments";
			$connection = db_connect();
            $result_set = mysqli_query($connection, $query);
    
            while($tournaments = mysqli_fetch_assoc($result_set)){
                echo "<tr>";
                    echo "<td>".$tournaments["tournamentID"]."</td>";
                    echo "<td>".$tounrnaments["signupDeadline"]."</td>";
                    echo "<td> <a href=tournamentEdit.php?id=".$tournmanets["tournamentID"].">Edit</td>";
                    echo "<td> <a href=tournamentDelete.php?id=".$tournamnets["tournamentID"].">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
	<br>
    <a href=tournamentCreate.php>Create</a>
	<br>
    <br>
	
  </body>
</html>

<?php 
    mysqli_free_result($result_set);
    db_disconnect($connection)
?>
