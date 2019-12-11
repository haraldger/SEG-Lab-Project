<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}
?>


<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content" class="container mt-5 mb-5">
  <div id="main-menu">
    <h2>Main Menu</h2>

    <br>
      <p><a href="<?php echo url_for('/officer/news.php'); ?>"><button type="button" class="btn btn-outline-dark">News</button></a></p>
      <p><a href="<?php echo url_for('/officer/events.php'); ?>"><button type="button" class="btn btn-outline-dark">Events</button></a></p>
	  <p><a href="<?php echo url_for('/officer/tournaments.php'); ?>"><button type="button" class="btn btn-outline-dark">Tournaments</button></a></p>
	  <p><a href="<?php echo url_for('/officer/viewMembers.php'); ?>"><button type="button" class="btn btn-outline-dark">Members</button></a></p>
	  <p><a href="<?php echo url_for('/officer/statistics.php'); ?>"><button type="button" class="btn btn-outline-dark">Member Elo distribution</button></a></p>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
