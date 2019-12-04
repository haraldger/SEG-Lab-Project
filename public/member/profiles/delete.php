<?php
require_once('../../../private/initialise.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/member/profiles/index.php'));
}
$id = $_GET['id'];
$member = Member::find_by_id($id);
if($member == false) {
  redirect_to(url_for('/member/profiles/index.php'));
}

if(is_post_request()) {
    $result = $member->delete();
    //$session->message('The member was deleted successfully.');
    redirect_to(url_for('/member/profiles/index.php'));
  
  } else {
    // Display form
  }
  
  ?>

<?php $page_title = 'Delete Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/member/profiles/index.php?id='. h(u($id)));  ?>">&laquo; Back to Profile</a>

  <div class="member delete">
    <h1>Delete Profile</h1>
    <p>Are you sure you want to delete your profile?</p>

    <form action="<?php echo url_for('/member/profiles/delete.php?id=' . h(u($member->id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
