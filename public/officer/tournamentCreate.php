<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/tournament.class.php'); 

if(is_post_request()) {

	$tournament = [];
	$tournament['signupDeadline'] = $_POST['signupDeadline'] ?? '';
	
	$new_tournament = new Tournament($tournament);
	$result = $new_tournament->create();
  
	if($result == false){
		$errors = $new_tournament->errors;
	}
	else{
		redirect_to(url_for('officer/tournaments.php'));
	}
  
} else {

	$tournament = [];
	$tournament['signupDeadline'] = '';
}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

<!doctype html>

<html lang="en">
  <head>
    <title>Create Tournament</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/officerStyle.css" />
  </head>
  <body>
  
	<div id="content">

	  <a class="back-link" href="<?php echo url_for('/officer/tournaments.php'); ?>">&laquo; Back to List</a>

	  <div class="tournament new">
		<h1>Create Tournament</h1>

		<?php echo display_errors($errors); ?>
		
		<form action="<?php echo url_for('/officer/tournamentCreate.php'); ?>" method="post">
		  <dl>
			<dt>Signup Deadline</dt>
			<dd><input type="datetime-local" name="signupDeadline" value="<?php echo h($tournament['signupDeadline']); ?>" /></dd>
		  </dl>
		  <div id="operations">
			<input type="submit" value="Create Tournament" />
		  </div>
		</form>
		<br>
	  </div>

	</div>
  </body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>
