<?php
require_once('../../private/initialise.php');
require_once(SHARED_PATH .'/classes/tournament.class.php');

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

if(!isset($_GET['tid'])){
	redirect_to(url_for('officer/tournaments.php'));
}
if(!isset($_GET['oid'])) {
	redirect_to(url_for('officer/tournamentOrganisers.php?id=' . $_GET['tid']));
}

$tid = $_GET['tid'];
$oid = $_GET['oid'];

$tournament = Tournament::find_by_id($tid);

$organiserIDs = array();
$counter = 0;
foreach($tournament->get_organisers() as $organiser){
	$organiserIDs[$counter] = $organiser->id;
	$counter++;
}

if(!in_array(get_session_id(), $organiserIDs) || get_session_id() == $oid){
	redirect_to(url_for('officer/tournamentOrganisers.php?id=' . $tid));
}

if(is_post_request()) {
	
	
	
	$tournament->remove_organiser($oid);
	
	redirect_to(url_for('officer/tournamentOrganisers.php?id=' . $tid));
}

?>

<?php $page_title = 'Delete Tournament Organiser'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>
<!doctype html>


	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('officer/tournamentOrganisers.php?id=' . $tid); ?>">&laquo; Back to List</a>
		<br><br>
	  <div class="tournament organiser delete">
		<h1>Delete Tournament Organiser</h1> <hr>
		<p>Are you sure you want to delete this ?</p>
		<p class="item"><?php echo "tournament ID: ".h($tid); ?></p><br>
		<p class="item"><?php echo "organiser ID: ".h($oid); ?></p><br>
		<form action="<?php echo url_for('/officer/tournamentOrganiserDelete.php?oid=' .h(u($oid)). '&tid=' .h(u($tid))); ?>" method="post">
		  <div id="operations">
			<input type="submit" class="btn btn-danger" name="commit" value="Delete organiser" />
		  </div>
		</form>
		<br>
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
