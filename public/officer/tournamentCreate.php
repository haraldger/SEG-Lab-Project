<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

require_once(SHARED_PATH .'/classes/tournament.class.php'); 

if(is_post_request()) {
	$tournament = new Tournament($_POST);
	$result = $tournament->save();
	$tournament->add_organiser(get_session_id());
	
	if($result == false){
		
	} else{
		redirect_to(url_for('officer/tournaments.php'));
	}
  
	} else {
		$tournament = new Tournament;
	}

?>

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('/officer/tournaments.php'); ?>">&laquo; Back to List</a>
		<br><br>
	  <div class="tournament new">
		<h1>Create Tournament</h1><br><hr>

		<?php echo display_errors($tournament->errors); ?>

		<form action="<?php echo url_for('/officer/tournamentCreate.php'); ?>" method="post">
		<div class="form-group">
		  <dl>
			<dt>Signup Deadline</dt>
			<dd><input class="form-control" type="datetime-local" name="signupDeadline" value="<?php echo h($tournament->signupDeadline); ?>" /></dd>
		  </dl>
		  </div>
		  <div class="form-group">
		  <dl>
		  	<dt>Name of Tournament</dt>
			  <dd><input class="form-control" type="text" name="name" value="<?php echo h($tournament->name); ?>" /></dd>
		  </dl>
		  </div>
		  <div id="operations">
			<input class= "btn btn-primary btn-lg" type="submit" value="Create Tournament" />
		  </div>
		</form>
		<br>
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
