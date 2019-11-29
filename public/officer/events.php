<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/classes/societyevent.class.php');

if(is_post_request()) {
	$query = "SELECT * FROM societyEvents";
}
else{
	date_default_timezone_set("Europe/London");
	$date = date('Y-m-d H:i:s', time());
	$query = "SELECT * FROM societyEvents WHERE releaseDate < '".$date."' AND expiryDate > '".$date."'";
}
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Events</title>
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

    <h1>Events</h1>
    
    <table>
        <tr>
            <th>Event ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Event Date</th>
            <th>Release Date</th>
            <th>Expiry Date</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
            
        </tr>
        <?php			
			$connection = db_connect();
            $result_set = mysqli_query($connection, $query);
    
            while($events = mysqli_fetch_assoc($result_set)){
                echo "<tr>";
                    echo "<td>".$events["eventID"]."</td>";
                    echo "<td>".$events["name"]."</td>";
                    echo "<td>".$events["description"]."</td>";
                    echo "<td>".$events["eventDate"]."</td>";
                    echo "<td>".$events["releaseDate"]."</td>";
                    echo "<td>".$events["expiryDate"]."</td>";
                    echo "<td> <a href=eventEdit.php?id=".$events["eventID"].">Edit</td>";
                    echo "<td> <a href=eventDelete.php?id=".$events["eventID"].">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
	<br>
	
	<?php
		if(is_post_request()){
			echo "<form action=".url_for('/officer/events.php')." method='get'>";
				echo "<div id='operations'>";
				echo "<input type='submit' value='Hide unreleased/expired events' />";
		}
		else{
			echo "<form action=".url_for('/officer/events.php')." method='post'>";
				echo "<div id='operations'>";
				echo "<input type='submit' value='Show unreleased/expired events' />";
		}
		
		echo "</div>";
		echo "</form>";
	?>
	
    <a href=eventCreate.php>Create</a>
    <br>
	<br>
  </body>
</html>

<?php
	include(SHARED_PATH . '/footer.php');
	
    mysqli_free_result($result_set);
    db_disconnect($connection)
?>
