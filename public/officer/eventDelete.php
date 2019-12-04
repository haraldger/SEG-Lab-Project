<?php
require_once('../../private/initialise.php');
require_once(SHARED_PATH .'/classes/societyevent.class.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/events.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
	
	$event['id'] = $id;
	$new_event = new SocietyEvent($event);
	$result = $new_event->delete();
	
	if($result){
		redirect_to(url_for('officer/events.php'));
	}
}

?>

<?php $page_title = 'Delete Society Event'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>

<!doctype html>

<html lang="en">
  <head>
    <title>Delete Event</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/officerStyle.css" />
  </head>

  <body>
	<div id="content">

	  <a class="back-link" href="<?php echo url_for('officer/events.php'); ?>">&laquo; Back to List</a>

	  <div class="event delete">
		<h1>Delete Society Event</h1>
		<p>Are you sure you want to delete this event?</p>
		<p class="item"><?php echo "Society Event ID: ".h($id); ?></p>

		<form action="<?php echo url_for('/officer/eventDelete.php?id=' .h(u($id))); ?>" method="post">
		  <div id="operations">
			<input type="submit" name="commit" value="Delete Event" />
		  </div>
		</form>
		<br>
		
	  </div>

	</div>
  </body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>
