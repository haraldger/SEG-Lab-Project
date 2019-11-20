<?php require_once('../../private/shared/initialise.php'); ?>

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
            
        </tr>
        <?php 
            $query = "SELECT * FROM societyEvents";
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
                    echo "<td> <a href=newsEdit.php?id=".$events["eventID"].">Edit</td>";
                    //echo "<td> <a href="?delete=$events["id"]">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <a href=eventsCreate.php>Create
    
  </body>
</html>

<?php 
    mysqli_free_result($result_set);
    db_disconnect($connection)
?>
