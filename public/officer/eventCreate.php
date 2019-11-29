<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/societyevent.class.php'); 

if(is_post_request()) {

	$event = [];
	$event['name'] = $_POST['name'] ?? '';
	$event['description'] = $_POST['description'] ?? '';
	$event['eventDate'] = $_POST['eventDate'] ?? '';
	$event['releaseDate'] = $_POST['releaseDate'] ?? '';
	$event['expiryDate'] = $_POST['expiryDate'] ?? '';
	
	$new_event = new SocietyEvent($event);
	$result = $new_event->create();
  
	if($result == false){
		$errors = $new_event->errors;
	}
	else{
		redirect_to(url_for('officer/events.php'));
	}
  
} else {

	$event = [];
	$event['name'] = '';
	$event['description'] = '';
	$event['eventDate'] = '';
	$event['releaseDate'] = '';
	$event['expiryDate'] = '';

}

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/officer/events.php'); ?>">&laquo; Back to List</a>

  <div class="event new">
	<h1>Create Society Event</h1>

	<?php echo display_errors($errors); ?>
	
	<form action="<?php echo url_for('/officer/eventCreate.php'); ?>" method="post">
	  <dl>
		<dt>Name</dt>
		<dd><input type="text" name="name" value="<?php echo h($event['name']); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Description</dt>
		<dd>
		  <textarea name="description" cols="60" rows="10"><?php echo h($event['description']); ?></textarea>
		</dd>
	  </dl>
	  <dl>
		<dt>Event Date</dt>
		<dd><input type="datetime-local" name="eventDate" value="<?php echo h($event['eventDate']); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Release Date</dt>
		<dd><input type="datetime-local" name="releaseDate" value="<?php echo h($event['releaseDate']); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Expiry Date</dt>
		<dd><input type="datetime-local" name="expiryDate" value="<?php echo h($event['expiryDate']); ?>" /></dd>
	  </dl>
	  <div id="operations">
		<input type="submit" value="Create Event" />
	  </div>
	</form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
