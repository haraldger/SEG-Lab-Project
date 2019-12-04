<?php require_once('../../../private/initialise.php'); ?>

<?php
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/member/profiles/index.php')); //replace with home page?
      }
    $id = $_GET['id'];
    $member = Member::find_by_id($id);
    if($member == false) {
      redirect_to(url_for('//member/profiles/index.php'));
    }
    
    if(is_post_request()) {
        $args = $_POST['member'];
        $member->merge_attributes($args);
        $result = $member->save();
        echo $result;

        if($result === true) {
          //$session->message('The member was updated successfully.');
          redirect_to(url_for('/member/profiles/index.php?id=' . $id));
        } else {
          // show errors
        }
    
    } else {  
        // display the form
    }
?>

<?php $page_title = 'Edit Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/member/profiles/index.php?id='.$id); ?>">&laquo; Back to Profile</a>

  <div class="member edit">
    <h1>Edit Profile</h1>

    <?php echo display_errors($member->errors); ?>

    <form action="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($id))); ?>" method="post">
        
      <?php
      if(!isset($member)) {
        redirect_to(url_for('/member/profiles/index.php')); //change to home page
      }
      ?>

      First Name:<br>
      <input type="text" name="member[fName]" value="<?php echo h($member->fName); ?>" /><br><br>
      Last Name:<br>
      <input type="text" name="member[lName]" value="<?php echo h($member->lName); ?>" /><br><br>
      Address:<br>
      <input type="text" name="member[address]" value="<?php echo h($member->address); ?>" /><br><br>
      Phone Number:<br>
      <input type="text" name="member[phoneNum]" value="<?php echo h($member->phoneNum); ?>" /><br><br>
      Gender:<br>
      <input type="radio" name="member[gender]" value="Male" <?php if ($member->gender=='Male') { echo 'checked'; } ?>> Male<br>
      <input type="radio" name="member[gender]" value="Female" <?php if ($member->gender=='Female') { echo 'checked'; } ?>> Female<br>
      <input type="radio" name="member[gender]" value="Other" <?php if ($member->gender=='Other') { echo 'checked'; } ?>> Other<br><br>
      Date of Birth:<br>
      <input type="date" name="member[dob]" value="<?php echo h($member->dob); ?>" /><br><br>
  
        <div id="operations">
            <input type="submit" value="Submit" />
        </div><br>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

