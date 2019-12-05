<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/officer_header.php');
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
<div class="container mt-5 mb-5">
    <h1>News</h1> <br>
    
    <table class="table">
      <thead>
        <tr>
            <th scope="col">News ID</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Description</th>
            <th scope="col">Release Date</th>
            <th scope="col">Expiry Date</th>
			<th>&nbsp;</th>
			<th>
      <div class="actions">
        <a href=newsCreate.php><button class="btn btn-primary btn-lg">+</button></a>
      </div>
      
      </th>
        </tr>
      </thead>
      <tbody>
      <?php
			$connection = db_connect();
            $result_set = mysqli_query($connection, $query);
			
            foreach($result_set as $news){
                echo "<tr>";
                    echo "<th scope=\"row\">".$news["id"]."</th>";
                    echo "<td>".$news["title"]."</td>";
                    echo "<td>".$news["authorID"]."</td>";
                    echo "<td>".$news["description"]."</td>";
                    echo "<td>".$news["releaseDate"]."</td>";
                    echo "<td>".$news["expiryDate"]."</td>";
                    echo "<td> <a href=newsEdit.php?id=".$news["id"].">Edit</td>";
                    echo "<td> <a href=newsDelete.php?id=".$news["id"].">Delete</td>";
                echo "</tr>";
            }
        ?>
      
      </tbody>
    </table>
   
	<br>
	
	<?php
		if(is_post_request()){
			echo "<form action=".url_for('/officer/news.php')." method='get'>";
				echo "<div id='operations'>";
				echo "<input type='submit' class='btn btn-danger' value='Hide unreleased / expired news' />";
		}
		else{
			echo "<form action=".url_for('/officer/news.php')." method='post'>";
				echo "<div id='operations'>";
				echo "<input type='submit' class='btn btn-info' value='Show unreleased / expired news' />";
		}
		
		echo "</div>";
		echo "</form>";
	?>
	<br>


	<br>

</div> 
<?php 
	include(SHARED_PATH . '/footer.php');
	
	mysqli_free_result($result_set);
    db_disconnect($connection)
?>