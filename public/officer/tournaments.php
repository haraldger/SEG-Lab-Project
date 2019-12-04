<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/officer_header.php');
include(SHARED_PATH . '/classes/tournament.class.php');
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Tournaments</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/officerStyle.css" />
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
                    echo "<td>".$tournaments["id"]."</td>";
                    echo "<td>".$tounrnaments["signupDeadline"]."</td>";
                    echo "<td> <a href=tournamentEdit.php?id=".$tournmanets["id"].">Edit</td>";
                    echo "<td> <a href=tournamentDelete.php?id=".$tournamnets["id"].">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
	<br>
    <h5><a href=tournamentCreate.php>Create Tournament</a></h5>
	<br>
    <br>
	
  </body>
</html>

<?php 
    mysqli_free_result($result_set);
    db_disconnect($connection)
?>
