<?php 
require_once('../../../private/initialise.php'); 
require_once('../../../private/shared/classes/news.class.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../../public'));
}

// TODO: set authorID to currently logged in user's ID
if(is_post_request()) {
  $news = new News($_POST);
  $news->authorID = get_session_id();
  $result = $news->save();
  
  if($result == true){
	redirect_to(url_for('officer/news/news.php'));
  }
} 
else{
  $news = new News;
}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

		<div id="content" class="container mt-5 mb-5">

		  <a class="back-link" href="<?php echo url_for('/officer/news/news.php'); ?>">&laquo; Back to List</a>
			<br><br>
		  <div class="news new">
			<h1>Create News</h1>
			<hr>
			<?php echo display_errors($news->errors); ?>
			
			<form action="<?php echo url_for('/officer/news/newsCreate.php'); ?>" method="post">
			<div class="form-group">
				<dl>
				<label>Title</label>
				<dd>
				<input type="text" class="form-control" name="title" value="<?php echo h($news->title); ?>" />
				</dd>
			  </dl>
			</div>
			<div class="form-group">
			  <dl>
				<label>Description</label>
				<dd>
				  <textarea class="form-control" name="description" cols="60" rows="10"><?php echo h($news->description); ?></textarea>
				</dd>
			  </dl>
			</div>
			  <dl>
				<label>Release Date</label>
				<dd>
				<input class="form-control" type="datetime-local" name="releaseDate" value="<?php echo h($news->releaseDate); ?>" /></dd>
			  </dl>
			  <dl>
				<label>Expiry Date</label>
				<dd><input class="form-control" type="datetime-local" name="expiryDate" value="<?php echo h($news->expiryDate); ?>" /></dd>
			  </dl>
			  <div id="operations">
				<input type="submit" class="btn btn-primary btn-lg" value="Create News" />
			  </div>
			</form>
			<br>
		  </div>

		</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
