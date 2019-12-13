<?php require_once('../../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments/tournaments.php'));
}

$id = $_GET['id'];
$tournamentItem = Tournament::find_by_id($id);

$organiserIDs = array();
$counter = 0;
foreach($tournamentItem->get_organisers() as $organiser){
	$organiserIDs[$counter] = $organiser->id;
	$counter++;
}

if(!in_array(get_session_id(), $organiserIDs)){
	redirect_to(url_for('officer/tournaments/tournaments.php?id=' . $id));
}

if(is_post_request()) {

	$tournamentItem->name = $_POST["name"];
	$tournamentItem->signupDeadline = $_POST["signupDeadline"];
	$result = $tournamentItem->save();
  
	if($result == false){
		
	}
	else{
		redirect_to(url_for('officer/tournaments/tournaments.php'));
	}
  
} else {

}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('/officer/tournaments/tournaments.php'); ?>">&laquo; Back to List</a>
	  <br><br>
	  <div>
		<h1>Edit Tournament</h1><br><hr>
		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/officer/tournaments/tournamentEdit.php?id=' . h(u($id))); ?>" method="post">
		<div class="form-group">
		  <dl>
			<dt>Name</dt>
			<dd><input type="text" class="form-control" name="name" value="<?php echo h($tournamentItem->name); ?>" /></dd>
		  </dl>
		</div>
		<div class="form-group">
		  <dl>
			<dt>Sign Up Deadline</dt>
			<dd><input type="datetime-local" class="form-control" name="signupDeadline" value="<?php echo substr($tournamentItem->signupDeadline, 0, 10)."T".substr($tournamentItem->signupDeadline, 11, 8) ?>" /></dd>
		  </dl>
		</div>
		  <div id="operations">
			<input type="submit" class="btn btn-primary" value="Update Tournament" />
		  </div>
		</form>
		<br>
	  </div>

	</div>
  </body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>
