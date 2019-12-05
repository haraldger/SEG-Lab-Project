<?php
require_once('../../private/initialise.php');
require_once(SHARED_PATH .'/classes/tournament.class.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/tournaments.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
	
	$tournament['id'] = $id;
	$new_tournament = new Tournament($tournament);
	$result = $new_tournament->delete();
	
	if($result){
		redirect_to(url_for('officer/tournaments.php'));
	}
}

?>

<?php $page_title = 'Delete Tournament'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>
<!doctype html>


	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('officer/tournaments.php'); ?>">&laquo; Back to List</a>
		<br><br>
	  <div class="tournament delete">
		<h1>Delete Tournament</h1> <hr>
		<p>Are you sure you want to delete this ?</p>
		<p class="item"><?php echo "tournament ID: ".h($id); ?></p><br>

		<form action="<?php echo url_for('/officer/tournamentDelete.php?id=' .h(u($id))); ?>" method="post">
		  <div id="operations">
			<input type="submit" class="btn btn-danger" name="commit" value="Delete tournament" />
		  </div>
		</form>
		<br>
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
