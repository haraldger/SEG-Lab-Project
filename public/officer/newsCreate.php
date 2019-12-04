<?php require_once('../../private/initialise.php'); 

require_once(SHARED_PATH .'/classes/news.class.php'); 

if(is_post_request()) {

	$news = [];
	$news['title'] = $_POST['title'] ?? '';
	$news['authorID'] = $_POST['authorID'] ?? '';
	$news['description'] = $_POST['description'] ?? '';
	$news['releaseDate'] = $_POST['releaseDate'] ?? '';
	$news['expiryDate'] = $_POST['expiryDate'] ?? '';
	
	$new_news = new News($news);
	$result = $new_news->create();
  
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
	$news['title'] = '';
	$news['authorID'] = '';
	$news['description'] = '';
	$news['releaseDate'] = '';
	$news['expiryDate'] = '';

}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

		<div id="content" class="container mt-5 mb-5">

		  <a class="back-link" href="<?php echo url_for('/officer/news.php'); ?>">&laquo; Back to List</a>
			<br><br>
		  <div class="news new">
			<h1>Create News</h1>
			<hr>
			<?php echo display_errors($errors); ?>
			
			<form action="<?php echo url_for('/officer/newsCreate.php'); ?>" method="post">
			<div class="form-group">
				<dl>
				<label>Title</label>
				<dd>
				<input type="text" class="form-control" name="title" value="<?php echo h($news['title']); ?>" />
				</dd>
			  </dl>
			</div>
			<div class="form-group">
			  <dl>
				<label>Author</label>
				<dd><input type="text" class="form-control" name="authorID" value="<?php echo h($news['authorID']); ?>" /></dd>
			  </dl>
			</div>
			<div class="form-group">
			  <dl>
				<label>Description</label>
				<dd>
				  <textarea class="form-control" name="description" cols="60" rows="10"><?php echo h($news['description']); ?></textarea>
				</dd>
			  </dl>
			</div>
			  <dl>
				<label>Release Date</label>
				<dd>
				<input class="form-control" type="datetime-local" name="releaseDate" value="<?php echo h($news['releaseDate']); ?>" /></dd>
			  </dl>
			  <dl>
				<label>Expiry Date</label>
				<dd><input class="form-control" type="datetime-local" name="expiryDate" value="<?php echo h($news['expiryDate']); ?>" /></dd>
			  </dl>
			  <div id="operations">
				<input type="submit" class="btn btn-primary btn-lg"value="Create News" />
			  </div>
			</form>
			<br>
		  </div>

		</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
