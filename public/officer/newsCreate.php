<?php require_once('../../private/initialise.php'); 

	require_once('../../private/shared/classes/news.class.php'); 

if(is_post_request()) {

  $news = [];
  $news['title'] = $_POST['title'] ?? '';
  $news['authorID'] = $_POST['authorID'] ?? '';
  $news['description'] = $_POST['description'] ?? '';
  $news['releasedate'] = $_POST['release_date'] ?? '';
  $news['expirydate'] = $_POST['expiry_date'] ?? '';
  

  $new_news = new News($news);
  $result = $new_news->create();
  
  if($result == false){
	echo $new_news->errors[0];
  }
  else{
	redirect_to(url_for('officer/news.php'));
  }
  
} else {

  $news = [];
  $news['title'] = '';
  $news['authorID'] = '';
  $news['description'] = '';
  $news['release_date'] = '';
  $news['expiry_date'] = '';

}

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Create News</title>
    <style>
        
    </style>
  </head>

  <body>

    <div id="content">

  <a class="back-link" href="<?php echo url_for('officer/news.php'); ?>">&laquo; Back to List</a>

  <div class="news new">
    <h1>Create News</h1>

	<?php echo display_errors($errors); ?>
	
    <form action="<?php echo url_for('/officer/newsCreate.php'); ?>" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo h($news['title']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Author</dt>
        <dd><input type="text" name="authorID" value="<?php echo h($news['authorID']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd>
          <textarea name="description" cols="60" rows="10"><?php echo h($news['description']); ?></textarea>
        </dd>
      </dl>
	  <dl>
        <dt>Release Date</dt>
        <dd><input type="text" name="release_date" value="<?php echo h($news['release_date']); ?>" /></dd>
      </dl>
	  <dl>
        <dt>Expiry Date</dt>
        <dd><input type="text" name="expiry_date" value="<?php echo h($news['expiry_date']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create News" />
      </div>
    </form>

  </div>

</div>
  </body>
</html>
