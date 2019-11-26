<?php require_once('../../../private/initialise.php'); ?>

<?php
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/index.php'));
    }
    $id = $_GET['id'];
    $member = find_member_by_id($id);
    //$member = ["memberID" => "1", "fName" => "Kristin", "lName" => "Benson", "address" => "123 Fake Street", "phoneNum" => "07123456789", "gender" => "Female", "dob" => "1999-11-08", "rating" => 1200, "role" => "Member"];

?>

<?php $page_title = 'Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/index.php'); // change to home page ?>">&laquo; Back to Home</a>

<div class="member show">

  <h1>Member: <?php echo h($member['fName']) . " " . h($member['lName']); ?></h1>
  <div class="attributes">
    <?php echo "First Name: " . h($member['fName']) . "<br>"; ?>
    <?php echo "Last Name: " . h($member['lName']) . "<br>"; ?>
    <?php echo "Address: " . h($member['address']) . "<br>"; ?>
    <?php echo "Phone Number: " . h($member['phoneNum']) . "<br>"; ?>
    <?php echo "Gender: " . h($member['gender']) . "<br>"; ?>
    <?php echo "Date of Birth: " . h($member['dob']) . "<br>"; ?>
    <?php echo "Rating: " . h($member['rating']) . "<br>"; ?>
    <?php echo "Role: " . h($member['role']) . "<br>"; ?>
    <a class="action" href="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($member['memberID']))); ?>">Edit Profile</a>
    <a class="action" href="<?php echo url_for('/member/profiles/delete.php?id=' . h(u($member['memberID']))); ?>">Delete Profile</a>
    	  
  </div>

</div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
