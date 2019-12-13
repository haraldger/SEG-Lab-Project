<?php require_once('../../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments/tournaments.php'));
}

$id = $_GET['id'];

$tournaments = Tournament::find_by_id($id);

$organiserIDs = array();
$counter = 0;
foreach($tournaments->get_organisers() as $organiser){
	$organiserIDs[$counter] = $organiser->id;
	$counter++;
}

if(!in_array(get_session_id(), $organiserIDs)){
	redirect_to(url_for('officer/tournaments/tournaments.php'));
}

include(SHARED_PATH . '/officer_header.php');
?>
    <div class="container mt-5 mb-5">
	<a class="back-link" href="<?php echo url_for('/officer/tournaments/tournaments.php'); ?>">&laquo; Back to List</a>
    <br>
    <br>
    <h3>Competitors</h1>
    
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Competitor ID</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">email</th>
			<th scope="col">Address</th>
			<th scope="col">Phone</th>			
        </tr>
    </thead>
        <?php
			$competitors = $tournaments->get_competitors();
			
            foreach($competitors as $competitor){
                echo "<tr>";
                    echo "<th scope=\"row\">".$competitor->id."</th>";
					echo "<th scope=\"row\">".$competitor->fName."</th>";
					echo "<th scope=\"row\">".$competitor->lName."</th>";
					echo "<th scope=\"row\">".$competitor->email."</th>";
					echo "<th scope=\"row\">".$competitor->address."</th>";
					echo "<th scope=\"row\">".$competitor->phoneNum."</th>";
                echo "</tr>";
            }
        ?>
    </table>
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>
