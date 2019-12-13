<?php
require_once('../../private/initialise.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('officer/viewMembers.php'));
}
$id = $_GET['id'];

if(is_post_request() && am_sysadmin()) {
	
    $member = Member::find_by_id($id);
    if($member->role=="Member"){
        $member->role = "Officer"; 
        $member->save();
    }
    else if($member->role=="Officer"){
        $member->role = "Member";
        $member->save();
    }
	
	if($result){
		redirect_to(url_for('officer/viewMembers.php'));
	}
}
else if(!am_sysadmin()){
    redirect_to(url_for('officer/viewMembers.php'));
}



?>

<?php $page_title = 'Edit Role'; ?>
<?php include(SHARED_PATH . '/officer_header.php'); ?>
<!doctype html>


	<div id="content" class="container mt-5 mb-5">

	  <a class="back-link" href="<?php echo url_for('officer/viewMembers.php'); ?>">&laquo; Back to List</a>
		<br><br>
	  <div class="news delete">
		<h1>Edit Role</h1> <hr>
        <p>Are you sure you want to <?php $update_term ?>this member?</p>
		<p class="item"><?php echo "Member ID: ".h($id); ?></p><br>

		<form action="<?php echo url_for('/officer/roleEdit.php?id=' .h(u($id))); ?>" method="post">
		  <div id="operations">
          <?php if(Member::find_by_id($id)->role=="Member"){?>
                <input type="submit" class="btn btn-primary" name="commit" value="Promote Member" />
          <?php }?>
          <?php if(Member::find_by_id($id)->role=="Officer"){?>
            <input type="submit" class="btn btn-danger" name="commit" value="Demote Member" />
          <?php }?>
			
		  </div>
		</form>
		<br>
	  </div>

	</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
