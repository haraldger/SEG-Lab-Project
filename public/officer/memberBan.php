<?php
require_once('../../private/initialise.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/officer/index.php'));
}
$id = $_GET['id'];
$member = Member::find_by_id($id);
if($member == false) {
  redirect_to(url_for('/officer/index.php'));
}

if(is_post_request()) {
  if ($member->role == "Member"){
    $sql = "INSERT INTO blacklist (email) " .  "VALUES ('" . $member->email . "');";
    $database->query($sql);
    $member->delete();
    redirect_to(url_for('/officer/index.php'));
  }
  else {
    $error_message = "You cannot ban an officer.";
  }
  
  } else {
    // Display form
  }
?>

<?php $page_title = 'Ban User'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content" class="container mt-5 mb-5">

  <a class="back-link" href="<?php echo url_for('/officer/index.php');  ?>">&laquo; Home</a>

  <div class="member ban">
    <?php if (isset($error_message)) echo $error_message; ?>
    <h1>Ban Member</h1>
    <p>Are you sure you want to ban this member?</p>

    <form action="<?php echo url_for('/officer/memberBan.php?id=' . h(u($member->id))); ?>" method="post">
      <div id="operations">
        <input type="submit" class="btn btn-danger" name="commit" value="Ban" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

