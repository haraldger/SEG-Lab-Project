<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/tournament.class.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments.php'));
}
$id = $_GET['id'];
$tournamentItem = Tournament::find_by_id($id);

if(is_post_request()) {

    $tournament = [];
    $tournament['id'] = $id;
    $tournament['name'] = $_POST['name'] ?? '';
    $tournament['signupDeadline'] = $_POST['signupDeadline'] ?? '';
	
	$new_tournament = new Tournament($tournament);
	$result = $new_tournament->update();
  
	if($result == false){
		if(empty($new_tournament->errors)){		
			$errorMessage = [];
			$errorMessage[] = "The author ID provided doesn't match any authors";
			
			$errors = $errorMessage;
		}
		else{
			$errors = $new_tournament->errors;
		}
	}
	else{
		redirect_to(url_for('officer/tournaments.php'));
	}
  
} else {

	$tournament = [];
    $tournament['id'] = $id;
    $tournament['name'] = '';
	$tournament['signupDeadline'] = '';
}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('/officer/tournaments.php'); ?>">&laquo; Back to List</a>
	  <br><br>
	  <div>
		<h1>Edit Tournament</h1><br><hr>
		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/officer/tournamentEdit.php?id=' . h(u($id))); ?>" method="post">
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
