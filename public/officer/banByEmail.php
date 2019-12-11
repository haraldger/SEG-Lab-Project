<?php 
require_once('../../private/initialise.php');

if(isset($_POST['email'])){
  
    $email = htmlspecialchars($_POST['email']);
    $member = Member::find_by_email($email);
    if($member){
      echo url_for('/officer/memberBan.php?id=' . h(u($member->id)));
    }
    else{
        insert_blacklist($email, $database);
        $msg = "User {$email} was banned successfully. ";
    }
}
?>

<?php include(SHARED_PATH . '/officer_header.php'); ?>

<div id="content" class="container mt-5 mb-5">

<br>

    <?php if (isset($error_message)) echo $error_message; ?>
    <h1>Ban Member</h1><br>
    <?php if(isset($msg)) { 
        echo "<p>" . $msg . "</p>";} else{ 
        echo "<p>This user was successfully banned.</p>";
        }?>
    <br>
    <a class="link" href="<?php echo url_for('/officer/viewMembers.php');  ?>">&laquo; Go back</a>

