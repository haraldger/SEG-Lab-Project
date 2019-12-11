<?php require_once('../private/initialise.php'); ?>
<?php $page_title = "Log In"; ?>

<?php include '../private/shared/header.php' ?>

<?php
    require_once('../private/initialise.php');
    require_once('../private/shared/classes/member.class.php');
	$errors = [];
	$email = '';
	$password = '';

	if(is_post_request()) {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validations
        if(is_blank($email)) {
            $errors[] = "email cannot be blank.";
        }
        if(is_blank($password)) {
            $errors[] = "Password cannot be blank.";
        }

        // if there were no errors, try to login
        if(empty($errors)) {
            $member = Member::find_by_email($email);
            // test if admin found and password is correct
            if(!$member){
                $errors[] = "Email not found :(";
            }
            else if ($member->verify_password($password)) {
                session_start();
                $_SESSION['id'] = $member->id;
                $_SESSION['name'] = $member->fName;
                $_SESSION["role"] = $member->role;
                $_SESSION["logged_in"] = true;
                redirect_to(url_for('index.php'));
            }
            else {
                // username not found or password does not match
                $errors[] = "Password doesn't match.";
            }
        }
    }

?>

<div class="container mt-5 mb-5">
<form action="<?php echo url_for('login.php'); ?>" method="post">
<h3>Member's Login</h3>
<hr><br>
    <?php echo(display_errors($errors));?>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>