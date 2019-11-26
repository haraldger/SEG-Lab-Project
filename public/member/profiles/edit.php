<?php require_once('../../../private/initialise.php'); ?>

<?php
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/member/profiles/index.php'));
      }
    $id = $_GET['id'];
    
    if(is_post_request()) {
    
        $member = [];
        $member['id'] = $id;
        $member['fName'] = $_POST['fName'] ?? '';
        $member['lName'] = $_POST['lName'] ?? '';
        $member['address'] = $_POST['address'] ?? '';
        $member['phoneNum'] = $_POST['phoneNum'] ?? '';
        $member['gender'] = $_POST['gender'] ?? '';
        $member['dob'] = $_POST['dob'] ?? '';
    
        $result = update_member($member);
        if($result === true) {
        redirect_to(url_for('/member/profiles/index.php?id=' . $id));
        } else {
        $errors = $result;
        }
    
    } else {  
        $member = find_member_by_id($id);
    }
?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/member/profiles/index.php?id='.$id); ?>">&laquo; Back to Profile</a>

  <div class="member edit">
    <h1>Edit Profile</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($id))); ?>" method="post">
        First Name:<br>
        <input type="text" name="fName" value="<?php echo h($member['fName']); ?>" /><br><br>
        Last Name:<br>
        <input type="text" name="lName" value="<?php echo h($member['lName']); ?>" /><br><br>
        Address:<br>
        <input type="text" name="address" value="<?php echo h($member['address']); ?>" /><br><br>
        Phone Number:<br>
        <input type="text" name="phoneNum" value="<?php echo h($member['phoneNum']); ?>" /><br><br>
        Gender:<br>
        <input type="radio" name="gender" value="Male" <?php if ($member['gender']=='Male') { echo 'checked'; } ?>> Male<br>
        <input type="radio" name="gender" value="Female" <?php if ($member['gender']=='Female') { echo 'checked'; } ?>> Female<br>
        <input type="radio" name="gender" value="Other" <?php if ($member['gender']=='Other') { echo 'checked'; } ?>> Other<br><br>
        Date of Birth:<br>
        <input type="date" name="dob" value="<?php echo h($member['dob']); ?>" /><br><br>
        <div id="operations">
            <input type="submit" value="Submit" />
        </div><br>
    </form>



  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

