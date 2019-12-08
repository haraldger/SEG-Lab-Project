<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

include(SHARED_PATH . '/officer_header.php');
require_once(SHARED_PATH . '/classes/societyevent.class.php');

if(is_post_request()) {
	$query = "SELECT * FROM societyEvents";
}
else{
	date_default_timezone_set("Europe/London");
	$date = date('Y-m-d H:i:s', time());
	$query = "SELECT * FROM societyEvents WHERE releaseDate < '".$date."' AND expiryDate > '".$date."'";
}
?>

<div class="container mt-5 mb-5">
  <a class="back-link" href="<?php echo url_for('/officer/index.php'); ?>">&laquo; Back to Menu</a>
  <br>
  <br>
	<h1>Events</h1> <br>
    
    <table class="table">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Event Date</th>
                <th>Release Date</th>
                <th>Expiry Date</th>
                <th>&nbsp;</th>
                <th>
                <a href=eventCreate.php><button class="btn btn-primary btn-lg">+</button></a>
                </th>
                
          </tr>   
        </thead>
        <tbody>
        <?php		
            $events = SocietyEvent::find_by_sql($query);
    
            foreach($events as $event){
                echo "<tr>";
                    echo "<th scope=\"row\">".$event->id."</th>";
                    echo "<td>".$event->name."</td>";
                    echo "<td>".$event->description."</td>";
                    echo "<td>".$event->eventDate."</td>";
                    echo "<td>".$event->releaseDate."</td>";
                    echo "<td>".$event->expiryDate."</td>";
                    echo "<td> <a href=eventEdit.php?id=".$event->id.">Edit</td>";
                    echo "<td> <a href=eventDelete.php?id=".$event->id.">Delete</td>";
                echo "</tr>";
            }	
        ?>
        </tbody>
    </table>
    
	<br>
	
	<?php
		if(is_post_request()){
			echo "<form action=".url_for('/officer/events.php')." method='get'>";
				echo "<div id='operations'>";
				echo "<input type='submit' class='btn btn-danger' value='Hide unreleased/expired events' />";
		}
		else{
			echo "<form action=".url_for('/officer/events.php')." method='post'>";
				echo "<div id='operations'>";
				echo "<input type='submit' class='btn btn-info' value='Show unreleased/expired events' />";
		}
		
		echo "</div>";
		echo "</form>";
	?>
	<br>
    <br>
	<br>

</div>
 
<?php
	include(SHARED_PATH . '/footer.php');
?>
