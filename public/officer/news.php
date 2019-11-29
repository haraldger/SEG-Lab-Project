<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/classes/news.class.php');

if(is_post_request()) {
	$query = "SELECT * FROM news";
}
else{
	date_default_timezone_set("Europe/London");
	$date = date('Y-m-d H:i:s', time());
	$query = "SELECT * FROM news WHERE releaseDate < '".$date."' AND expiryDate > '".$date."'";
}
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
			$connection = db_connect();
            $result_set = mysqli_query($connection, $query);
			
            foreach($result_set as $news){
                echo "<tr>";
                    echo "<td>".$news["newsID"]."</td>";
                    echo "<td>".$news["title"]."</td>";
                    echo "<td>".$news["authorID"]."</td>";
                    echo "<td>".$news["description"]."</td>";
                    echo "<td>".$news["releaseDate"]."</td>";
                    echo "<td>".$news["expiryDate"]."</td>";
                    echo "<td> <a href=newsEdit.php?id=".$news["newsID"].">Edit</td>";
                    echo "<td> <a href=newsDelete.php?id=".$news["newsID"].">Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
   
	<br>
	
	<?php
		if(is_post_request()){
			echo "<form action=".url_for('/officer/news.php')." method='get'>";
				echo "<div id='operations'>";
				echo "<input type='submit' value='Hide unreleased/expired news' />";
		}
		else{
			echo "<form action=".url_for('/officer/news.php')." method='post'>";
				echo "<div id='operations'>";
				echo "<input type='submit' value='Show unreleased/expired news' />";
		}
		
		echo "</div>";
		echo "</form>";
	?>
	
	<div class="actions">
      <a href=newsCreate.php>Create</a>
    </div>

	<br>
  </body>
</html>

<?php 
	include(SHARED_PATH . '/footer.php');
	
	mysqli_free_result($result_set);
    db_disconnect($connection)
?>