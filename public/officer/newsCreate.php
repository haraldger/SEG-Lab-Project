<?php require_once('../../private/initialise.php'); 

	require_once('../../private/shared/classes/news.class.php'); 

if(is_post_request()) {

  $news = [];
  $news['title'] = $_POST['title'] ?? '';
  $news['author'] = $_POST['author'] ?? '';
  $news['description'] = $_POST['description'] ?? '';
  $news['release_date'] = $_POST['release_date'] ?? '';
  $news['expiry_date'] = $_POST['expiry_date'] ?? '';

  $new_news = new News($news);
  
  echo $new_news -> $title;
  
  $result = $new_news->create();
  
  redirect_to(url_for('officer/news.php'));
  
} else {

  $news = [];
  $news['title'] = '';
  $news['author'] = '';
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
        <dd><input type="text" name="author" value="<?php echo h($news['author']); ?>" /></dd>
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
