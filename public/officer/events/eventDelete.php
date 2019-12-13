<?php
require_once('../../../private/initialise.php');

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/events/events.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
	
	$new_event = SocietyEvent::find_by_id($id);
	$result = $new_event->delete();
	
	if($result){
		redirect_to(url_for('officer/events/events.php'));
	}
}

?>

<?php $page_title = 'Delete Society Event'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>


	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('officer/events/events.php'); ?>">&laquo; Back to List</a>

	  <div class="event delete">
	  <br><br>
		<h1>Delete Society Event</h1><hr>
		<p>Are you sure you want to delete this event?</p>
		<p class="item"><?php echo "Society Event ID: ".h($id); ?></p> <br>

		<form action="<?php echo url_for('/officer/events/eventDelete.php?id=' .h(u($id))); ?>" method="post">
		  <div id="operations">
			<input type="submit" class= "btn btn-danger" name="commit" value="Delete Event" />
		  </div>
		</form>
		<br>
		
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
