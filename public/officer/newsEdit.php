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

<html lang="en">
  <head>
    <title>Edit News</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/officerStyle.css" />
  </head>

	<body>
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
		<br>
	  </div>

	</div>
  </body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>
