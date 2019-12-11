<?php require_once('../../private/initialise.php'); 
if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}
?>


<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content" class="container mt-5 mb-5">
<a class="back-link" href="<?php echo url_for('/officer/index.php'); ?>">&laquo; Back to Menu</a>
<br>
<br>
  <div id="main-menu">
    <h2>Elo statistics</h2>
    <img src="../../private/shared/elodistribution.php">
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>