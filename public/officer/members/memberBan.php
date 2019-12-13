<?php
require_once('../../../private/initialise.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/officer/index.php'));
}

$id = $_GET['id'];
$member = Member::find_by_id($id);
if($member == false || $member->role=="Officer" || $member->role=="System Admin" || !(am_officer() || am_sysadmin())) {
  redirect_to(url_for('/officer/members/viewMembers.php'));
}


  $id = htmlspecialchars($_GET['id']);
  $member = Member::find_by_id($id);
  if($member == false) {
    redirect_to(url_for('/officer/index.php'));
  }

  if(is_post_request()) {
    if ($member->role == "Member"){
      insert_blacklist($member->email, $database);
      $member->delete();
      redirect_to(url_for('/officer/members/banByEmail.php'));
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

  <a class="back-link" href="<?php echo url_for('/officer/members/viewMembers.php');  ?>">&laquo; Back to List</a>
<br><br>
  <div class="member ban">
    <?php if (isset($error_message)) echo $error_message; ?>
    <h1>Ban Member</h1>
    <p>Are you sure you want to ban this member? Banning a member will delete their account. </p><br>


    <form action="<?php echo url_for('/officer/members/memberBan.php?id=' . h(u($member->id))); ?>" method="post">
      <div id="operations">
        <input type="submit" class="btn btn-danger"name="commit" value="Permanently Ban" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

