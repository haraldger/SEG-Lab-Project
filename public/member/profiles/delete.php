<?php
require_once('../../../private/initialise.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/member/profiles/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

    $result = delete_member($id);
    redirect_to(url_for('/member/profiles/index.php'));
  
  } else {
    $member = find_member_by_id($id);
  }
  
  ?>

<?php $page_title = 'Delete Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/member/profiles/index.php?id='.$id);  ?>">&laquo; Back to Profile</a>

  <div class="member delete">
    <h1>Delete Profile</h1>
    <p>Are you sure you want to delete your profile?</p>

    <form action="<?php echo url_for('/member/profiles/delete.php?id=' . h(u($member['memberID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
