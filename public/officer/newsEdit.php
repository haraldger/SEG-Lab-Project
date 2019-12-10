<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/news.class.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/news.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

	$newsItem = new News($_POST);
	$newsItem->id = $id;
	$newsItem->authorID = get_session_id();
	$result = $newsItem->save();

	if($result == false){
		// error!
	}
	else{
		redirect_to(url_for('officer/news.php'));
	}
  
} else {
	$newsItem = News::find_by_id($id);
}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('/officer/news.php'); ?>">&laquo; Back to List</a>
	  <br><br>
	  <div class="news edit">
		<h1>Edit News</h1><br><hr>
		<?php echo display_errors($newsItem->errors); ?>

		<form action="<?php echo url_for('/officer/newsEdit.php?id=' . h(u($id))); ?>" method="post">
		<div class="form-group">
		  <dl>
			<dt>Title</dt>
			<dd><input type="text" class="form-control" name="title" value="<?php echo h($newsItem->title); ?>" /></dd>
		  </dl>
		</div>
		<div class="form-group">
		  <dl>
			<dt>Description</dt>
			<dd>
			  <textarea name="description" class="form-control" cols="60" rows="10"><?php echo h($newsItem->description); ?></textarea>
			</dd>
		  </dl>
		</div>
		<div class="form-group">
		  <dl>
			<dt>Release Date</dt>
			<dd><input type="datetime-local" class="form-control" name="releaseDate" value="<?php echo substr($newsItem->releaseDate, 0, 10)."T".substr($newsItem->releaseDate, 11, 8) ?>" /></dd>
		  </dl>
		</div>
		<div class="form-group">
		  <dl>
			<dt>Expiry Date</dt>
			<dd><input type="datetime-local" class="form-control" name="expiryDate" value="<?php echo substr($newsItem->expiryDate, 0, 10)."T".substr($newsItem->expiryDate, 11, 8) ?>" /></dd>
		  </dl>
		</div>
		  <div id="operations">
			<input type="submit" class="btn btn-primary" value="Update News" />
		  </div>
		</form>
		<br>
	  </div>

	</div>
  </body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>
