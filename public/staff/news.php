<?php require_once('../../private/shared/initialise.php'); ?>

<!doctype html>

<html lang="en">
  <head>
    <title>News</title>
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

    <h1>News</h1>
    
    <table>
        <tr>
            <th>News ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Release Date</th>
            <th>Expiry Date</th>
            
        </tr>
        <?php 
            $query = "SELECT * FROM news";
            $result_set = mysqli_query($connection, $query);
    
            while($news = mysqli_fetch_assoc($result_set)){
                echo "<tr>";
                    echo "<td>".$news["id"]."</td>";
                    echo "<td>".$news["title"]."</td>";
                    echo "<td>".$news["author"]."</td>";
                    echo "<td>".$news["description"]."</td>";
                    echo "<td>".$news["releaseDate"]."</td>";
                    echo "<td>".$news["expiryDate"]."</td>";
                    echo "<td> <a href=newsEdit.php?id=".$news["id"].">Edit</td>";
                    //echo "<td> <a href="?delete=$news["id"]">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <a href=newsCreate.php>Create
    
  </body>
</html>

<?php 
    mysqli_free_result($result_set);
    mysqli_close($connection);
?>