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
            $tournaments = Tournament::find_all();
            foreach($tournaments as $tournament){
                echo "<tr>";
                    echo "<td>".$tournament->id."</td>";
                    echo "<td>".$tournament->signupDeadline."</td>";
                    echo "<td> <a href=tournamentEdit.php?id=".$tournament->id.">Edit</td>";
                    echo "<td> <a href=tournamentDelete.php?id=".$tournament->id.">Delete</td>";
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
include(SHARED_PATH . "/footer.php");
?>