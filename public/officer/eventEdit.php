<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/societyevent.class.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/events.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

	$eventItem = new SocietyEvent($_POST);
	$eventItem->id = $id;
	$result = $eventItem->save();
  
	if($result == false){
		// errors!
	}
	else{
		redirect_to(url_for('officer/events.php'));
	}
  
}else {
	$eventItem = SocietyEvent::find_by_id($id);
}

?>


<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/officer/events.php'); ?>">&laquo; Back to List</a>
  
  <div class="event edit">
    <h1>Edit Society Event</h1>

    <?php echo display_errors($eventItem->errors); ?>

    <form action="<?php echo url_for('/officer/eventEdit.php?id=' . h(u($id))); ?>" method="post">
	  <dl>
		<dt>Name</dt>
		<dd><input type="text" name="name" value="<?php echo h($eventItem->name); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Description</dt>
		<dd>
		  <textarea name="description" cols="60" rows="10"><?php echo h($eventItem->description); ?></textarea>
		</dd>
	  </dl>
	  <dl>
		<dt>Event Date</dt>
		<dd><input type="datetime-local" name="eventDate" value="<?php echo substr($eventItem->eventDate, 0, 10)."T".substr($eventItem->eventDate, 11, 8) ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Release Date</dt>
		<dd><input type="datetime-local" name="releaseDate" value="<?php echo substr($eventItem->releaseDate, 0, 10)."T".substr($eventItem->releaseDate, 11, 8) ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Expiry Date</dt>
		<dd><input type="datetime-local" name="expiryDate" value="<?php echo substr($eventItem->expiryDate, 0, 10)."T".substr($eventItem->expiryDate, 11, 8) ?>" /></dd>
	  </dl>
	  <div id="operations">
		<input type="submit" value="Update Event" />
	  </div>
	</form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
