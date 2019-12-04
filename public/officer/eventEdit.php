<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/societyevent.class.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/events.php'));
}
$id = $_GET['id'];
$eventItem = SocietyEvent::find_by_id($id);

if(is_post_request()) {

	$event = [];
	$event['id'] = $id;
	$event['name'] = $_POST['name'] ?? '';
	$event['description'] = $_POST['description'] ?? '';
	$event['eventDate'] = $_POST['eventDate'] ?? '';
	$event['releaseDate'] = $_POST['releaseDate'] ?? '';
	$event['expiryDate'] = $_POST['expiryDate'] ?? '';
	
	$new_event = new SocietyEvent($event);
	$result = $new_event->update();
  
	if($result == false){
		
		$errors = $new_event->errors;	
	}
	else{
		redirect_to(url_for('officer/events.php'));
	}
  
} else {

	$event = [];
	$event['id'] = $id;
	$event['name'] = '';
	$event['eventDate'] = '';
	$event['description'] = '';
	$event['releaseDate'] = '';
	$event['expiryDate'] = '';

}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

<!doctype html>

<html lang="en">
  <head>
    <title>Edit Event</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/officerStyle.css" />
  </head>

  <body>
	<div id="content" class="container mt-5 mb-5">
	<a class="back-link" href="<?php echo url_for('/officer/events.php'); ?>">&laquo; Back to List</a>
	  <br><br>
	  
	  <div class="event edit">

		<h1>Edit Society Event</h1>

		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/officer/eventEdit.php?id=' . h(u($id))); ?>" method="post">
		<div class="form-group">
		  <dl>
			<dt>Name</dt>
			<dd><input type="text" class="form-control" name="name" value="<?php echo h($eventItem->name); ?>" /></dd>
		  </dl>
		  </div>
		  <div class="form-group">
		  <dl>
			<dt>Description</dt>
			<dd>
			  <textarea name="description" class="form-control" cols="60" rows="10"><?php echo h($eventItem->description); ?></textarea>
			</dd>
		  </dl>
		  </div>
		  <div class="form-group">
		  <dl>
			<dt>Event Date</dt>
			<dd><input type="datetime-local" class="form-control" name="eventDate" value="<?php echo substr($eventItem->eventDate, 0, 10)."T".substr($eventItem->eventDate, 11, 8) ?>" /></dd>
		  </dl>
		  </div>
		  <div class="form-group">
		  <dl>
			<dt>Release Date</dt>
			<dd><input type="datetime-local" class="form-control" name="releaseDate" value="<?php echo substr($eventItem->releaseDate, 0, 10)."T".substr($eventItem->releaseDate, 11, 8) ?>" /></dd>
		  </dl>
		  </div>
		  <div class="form-group">
		  <dl>
			<dt>Expiry Date</dt>
			<dd><input type="datetime-local" class="form-control" name="expiryDate" value="<?php echo substr($eventItem->expiryDate, 0, 10)."T".substr($eventItem->expiryDate, 11, 8) ?>" /></dd>
		  </dl>
		  </div>
		  <div id="operations">
			<input type="submit" class="btn btn-primary" value="Update Event" />
		  </div>
		</form>
	    <br>
	  </div>

	</div>
  </body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>
