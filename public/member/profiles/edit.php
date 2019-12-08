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

<div id="content" class="container mt-5 mb-5">

  <a class="back-link" href="<?php echo url_for('/member/profiles/index.php?id='.$id); ?>">&laquo; Back to Profile</a>

  <div class="member edit"><br><br>
    <h1>Edit Profile</h1>

    <?php echo display_errors($member->errors); ?>

    <form action="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($id))); ?>" method="post">
        
      <?php
      if(!isset($member)) {
        redirect_to(url_for('/member/profiles/index.php')); //change to home page
      }
      ?>
      <div class="form-group">
        <label >First Name: </label><br>
        <input type="text" class="form-control" name="member[fName]" value="<?php echo h($member->fName); ?>" />
      </div>
      <div class="form-group">
        <label >Last Name: </label><br>
        <input type="text" class="form-control" name="member[lName]" value="<?php echo h($member->lName); ?>" />
      </div>
      <div class="form-group">
        <label >Address: </label><br>
        <input type="text" class="form-control" name="member[address]" value="<?php echo h($member->address); ?>" />
      </div>
      <div class="form-group">
        <label >Phone Number: </label><br>
        <input type="text" class="form-control" name="member[phoneNum]" value="<?php echo h($member->phoneNum); ?>" />
      </div>
        <label >Gender: </label><br>
      <div class="form-check">
        <input type="radio" class="form-check-input" name="member[gender]" value="Male" <?php if ($member->gender=='Male') { echo 'checked'; } ?>> 
        <label class="form-check-label">Male</label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" name="member[gender]" value="Female" <?php if ($member->gender=='Female') { echo 'checked'; } ?>> 
        <label class="form-check-label">Female</label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" name="member[gender]" value="Other" <?php if ($member->gender=='Other') { echo 'checked'; } ?>>
        <label class="form-check-label">Other</label>
      </div><br>
      <div class="form-group">
        <label >Date of Birth: </label><br>
        <input type="date" class="form-control" name="member[dob]" value="<?php echo h($member->dob); ?>" />
      </div><br>
        <div id="operations">
        <input class="btn btn-primary btn-lg" type="submit" value="Save Changes" />
        </div><br>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

