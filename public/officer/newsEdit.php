<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/news.class.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/news.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

	$newsItem = new News($_POST);
	$newsItem->id = $id;
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

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/officer/news.php'); ?>">&laquo; Back to List</a>
  
  <div class="news edit">
    <h1>Edit News</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/officer/newsEdit.php?id=' . h(u($id))); ?>" method="post">
	  <dl>
		<dt>Title</dt>
		<dd><input type="text" name="title" value="<?php echo h($newsItem->title); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Author</dt>
		<dd><input type="text" name="authorID" value="<?php echo h($newsItem->authorID); ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Description</dt>
		<dd>
		  <textarea name="description" cols="60" rows="10"><?php echo h($newsItem->description); ?></textarea>
		</dd>
	  </dl>
	  <dl>
		<dt>Release Date</dt>
		<dd><input type="datetime-local" name="releaseDate" value="<?php echo substr($newsItem->releaseDate, 0, 10)."T".substr($newsItem->releaseDate, 11, 8) ?>" /></dd>
	  </dl>
	  <dl>
		<dt>Expiry Date</dt>
		<dd><input type="datetime-local" name="expiryDate" value="<?php echo substr($newsItem->expiryDate, 0, 10)."T".substr($newsItem->expiryDate, 11, 8) ?>" /></dd>
	  </dl>
	  <div id="operations">
		<input type="submit" value="Update News" />
	  </div>
	</form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
