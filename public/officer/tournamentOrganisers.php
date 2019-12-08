<?php require_once('../../private/initialise.php'); 
require_once(SHARED_PATH . '/classes/tournament.class.php');

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments.php'));
}

$id = $_GET['id'];

$tournaments = new Tournament();
$tournaments->id = $id;

if(is_post_request()) {
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
					echo "<td> <a href=tournamentOrganiserDelete.php?oid=$organiser->id&tid=$id>Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
	
	<?php echo display_errors($tournaments->errors); ?>
			
			<form action="<?php echo url_for('/officer/tournamentOrganisers.php?id='.$id); ?>" method="post">
			<div class="form-group">
				<dl>
				<label>Co-organiser email</label>
				<dd>
				<input type="text" class="form-control" name="email" value="" />
				</dd>
			  </dl>
			</div>
			<div id="operations">
				<input type="submit" class="btn btn-primary btn-lg" value="Add Organiser" />
			  </div>
			</form>
			<br>
    
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>
