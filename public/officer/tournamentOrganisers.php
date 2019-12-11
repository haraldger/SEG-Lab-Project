<?php require_once('../../private/initialise.php'); 
require_once(SHARED_PATH . '/classes/tournament.class.php');

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments.php'));
}

$id = $_GET['id'];

$tournaments = Tournament::find_by_id($id);

$organiserIDs = array();
$counter = 0;
foreach($tournaments->get_organisers() as $organiser){
	$organiserIDs[$counter] = $organiser->id;
	$counter++;
}

$is_organiser_of_this = in_array(get_session_id(), $organiserIDs);

if(is_post_request() && $is_organiser_of_this) {
  $member = Member::find_by_email($_POST["email"]);
  
  $tournaments->add_organiser($member->id);
}

include(SHARED_PATH . '/officer_header.php');
?>
    <div class="container mt-5 mb-5">
	<a class="back-link" href="<?php echo url_for('/officer/tournaments.php'); ?>">&laquo; Back to List</a>
    <br>
    <br>
    <h3>Organisers</h1>
    
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Organiser ID</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">email</th>
			<th scope="col">Address</th>
			<th scope="col">Phone</th>				
			<th scope="col">&nbsp;</th>			
        </tr>
    </thead>
        <?php
			$organisers = $tournaments->get_organisers();
			
            foreach($organisers as $organiser){
                echo "<tr>";
                    echo "<th scope=\"row\">".$organiser->id."</th>";
					echo "<th scope=\"row\">".$organiser->fName."</th>";
					echo "<th scope=\"row\">".$organiser->lName."</th>";
					echo "<th scope=\"row\">".$organiser->email."</th>";
					echo "<th scope=\"row\">".$organiser->address."</th>";
					echo "<th scope=\"row\">".$organiser->phoneNum."</th>";
					if($is_organiser_of_this && get_session_id()!=$organiser->id){
						echo "<td> <a href=tournamentOrganiserDelete.php?oid=$organiser->id&tid=$id>Delete</td>";
					}
					else{
						echo "<td>&nbsp;</td>";
					}
                echo "</tr>";
            }
        ?>
    </table>
	
	<?php
		if($is_organiser_of_this){
			echo display_errors($tournaments->errors);
				
			echo "<form action=".url_for('/officer/tournamentOrganisers.php?id='.$id)." method='post'>";
				echo "<div class='form-group'>";
					echo "<dl>";
						echo "<label>Co-organiser email</label>";
						echo "<dd>";
							echo "<input type='text' class='form-control' name='email' value='' />";
						echo "</dd>";
					echo "</dl>";
				echo "</div>";
				echo "<div id='operations'>";
					echo "<input type='submit' class='btn btn-primary btn-lg' value='Add Organiser' />";
				echo "</div>";
			echo "</form>";
			echo "<br>";
		}
    ?>
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>
