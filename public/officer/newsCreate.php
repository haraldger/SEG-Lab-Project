<?php 
require_once('../../private/initialise.php'); 
require_once('../../private/shared/classes/news.class.php'); 

// TODO: set authorID to currently logged in user's ID
if(is_post_request()) {
  $news = new News($_POST);
  $result = $news->save();
  
  if($result == true){
	redirect_to(url_for('officer/news.php'));
  }
} 
else{
  $news = new News;
}

?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>


<!doctype html>



<html lang="en">
  <head>
    <title>Create News</title>
  </head>

  <body>

    <div id="content">

  <a class="back-link" href="<?php echo url_for('officer/news.php'); ?>">&laquo; Back to List</a>

  <div class="news new">
    <h1>Create News</h1>

	<?php echo(display_errors($news->errors));?>
	
    <form action="<?php echo url_for('/officer/newsCreate.php'); ?>" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo h($news->title); ?>" /></dd>
      </dl>
      <dl>
        <dt>Author</dt>
        <dd><input type="text" name="authorID" value="<?php echo h($news->authorID); ?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd>
          <textarea name="description" cols="60" rows="10"><?php echo h($news->description); ?></textarea>
        </dd>
      </dl>
	  <dl>
        <dt>Release Date</dt>
        <dd><input type="datetime-local" name="releaseDate" value="<?php echo h($news->releaseDate); ?>" /></dd>
      </dl>
	  <dl>
        <dt>Expiry Date</dt>
        <dd><input type="datetime-local" name="expiryDate" value="<?php echo h($news->expiryDate); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create News" />
      </div>
    </form>

  </div>

</div>
  </body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>
