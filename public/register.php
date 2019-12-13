<?php require_once('../private/initialise.php'); ?>
<?php $page_title = "Register"; ?>

<?php 
  include('../private/shared/header.php');


  $member = new Member;
  if(is_post_request()) {
    // Create record using post parameters
    $member = new Member($_POST);
    $result = $member->save();
    if($result === true) {
      $new_id = $member->id;
      redirect_to(url_for("index.php"));
    } else {
    }
  }

?>
<html>
<div class="container mt-5 mb-5">
  <form action="<?php echo url_for('register.php'); ?>" method="post">
    <h3>Register as Member</h3>
    <?php echo(display_errors($member->errors));?>
    <hr>
    <br>
    <div class="form-row mt-2 mb-3">
      <div class="col">
        <label for="inputEmail4">First Name</label>
        <input type="text" class="form-control" name="fName" placeholder="First name" value="<?php echo h($member->fName); ?>">
      </div>
      <div class="col">
        <label for="inputEmail4">Last Name</label>
        <input type="text" class="form-control" name="lName" placeholder="Last name" value="<?php echo h($member->lName); ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo h($member->email); ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo h($member->password); ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password (Again)</label>
        <input type="password" class="form-control" name="confirm_password" placeholder="Re-enter Password">
      </div>      
      <div class="form-group col-md-6">
        <label for="phonenum">Phone number</label>
        <input type="tel" class="form-control" name="phoneNum" placeholder="7412345678" value="<?php echo h($member->phoneNum); ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" name="address" placeholder="1234 Main St" value="<?php echo h($member->address); ?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputState">Gender</label>
        <select name="gender" class="form-control">
          <option selected>Male</option>
          <option>Female</option>
          <option>Other</option>
        </select>
        <small class="form-text text-muted">For women's and men's competitions</small>
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip">Date of Birth</label>
        <input type="date" class="form-control" name="dob" value="<?php echo h($member->dob);?>">
        <small class="form-text text-muted">In the format YY/MM/DD</small>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>
</div>
</html>

