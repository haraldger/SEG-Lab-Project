<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/news.class.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/news.php'));
}
$id = $_GET['id'];
$newsItem = News::find_by_id($id);

if(is_post_request()) {

	$news = [];
	$news['id'] = $id;
	$news['title'] = $_POST['title'] ?? '';
	$news['authorID'] = $_POST['authorID'] ?? '';
	$news['description'] = $_POST['description'] ?? '';
	$news['releaseDate'] = $_POST['releaseDate'] ?? '';
	$news['expiryDate'] = $_POST['expiryDate'] ?? '';
	
	$new_news = new News($news);
	$result = $new_news->update();
  
	if($result == false){
		if(empty($new_news->errors)){		
			$errorMessage = [];
			$errorMessage[] = "The author ID provided doesn't match any authors";
			
			$errors = $errorMessage;
		}
		else{
			$errors = $new_news->errors;
		}
	}
	else{
		redirect_to(url_for('officer/news.php'));
	}
  
} else {

	$news = [];
	$news['id'] = $id;
	$news['title'] = '';
	$news['authorID'] = '';
	$news['description'] = '';
	$news['releaseDate'] = '';
	$news['expiryDate'] = '';

}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

<!doctype html>

	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('/officer/news.php'); ?>">&laquo; Back to List</a>
	  <br><br>
	  <div class="news edit">
		<h1>Edit News</h1><br><hr>
		<?php echo display_errors($errors); ?>

		<form action="<?php echo url_for('/officer/newsEdit.php?id=' . h(u($id))); ?>" method="post">
		<div class="form-group">
		  <dl>
			<dt>Title</dt>
			<dd><input type="text" class="form-control" name="title" value="<?php echo h($newsItem->title); ?>" /></dd>
		  </dl>
		</div>
		<div class="form-group">
		  <dl>
			<dt>Author</dt>
			<dd><input type="text" class="form-control" name="authorID" value="<?php echo h($newsItem->authorID); ?>" /></dd>
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
