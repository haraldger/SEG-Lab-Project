<?php
require_once('../../private/initialise.php');
require_once(SHARED_PATH .'/classes/news.class.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/news.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
	
	$news['id'] = $id;
	$new_news = new News($news);
	$result = $new_news->delete();
	
	if($result){
		redirect_to(url_for('officer/news.php'));
	}
}

?>

<?php $page_title = 'Delete News'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>
<!doctype html>


	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('officer/news.php'); ?>">&laquo; Back to List</a>
		<br><br>
	  <div class="news delete">
		<h1>Delete News</h1> <hr>
		<p>Are you sure you want to delete this news?</p>
		<p class="item"><?php echo "News ID: ".h($id); ?></p><br>

		<form action="<?php echo url_for('/officer/newsDelete.php?id=' .h(u($id))); ?>" method="post">
		  <div id="operations">
			<input type="submit" class="btn btn-danger" name="commit" value="Delete News" />
		  </div>
		</form>
		<br>
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
