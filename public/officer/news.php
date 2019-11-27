<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/classes/news.class.php');
?>



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
			<th>&nbsp;</th>
			<th>&nbsp;</th>
        </tr>
        <?php 
            $query = "SELECT * FROM news";
            $result_set = News::find_by_sql($query);
			
            foreach($result_set as $news){
                echo "<tr>";
                    echo "<td>".$news->id."</td>";
                    echo "<td>".$news->title."</td>";
                    echo "<td>".$news->authorID."</td>";
                    echo "<td>".$news->description."</td>";
                    echo "<td>".$news->releaseDate."</td>";
                    echo "<td>".$news->expiryDate."</td>";
                    echo "<td> <a href=newsEdit.php?id=".$news->newsID.">Edit</td>";
                    //echo "<td> <a href="?delete=$news["id"]">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
   
	<br>
	
	<div class="actions">
      <a href=newsCreate.php>Create</a>
    </div>

	<br>
  </body>
</html>

<?php 
	include(SHARED_PATH . '/footer.php');
    db_disconnect($connection)
?>