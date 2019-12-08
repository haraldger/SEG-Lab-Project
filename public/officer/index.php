<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}
?>


<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content" class="container mt-5 mb-5">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/officer/news.php'); ?>">News</a></li>
      <li><a href="<?php echo url_for('/officer/events.php'); ?>">Events</a></li>
	  <li><a href="<?php echo url_for('/officer/tournaments.php'); ?>">Tournaments</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
