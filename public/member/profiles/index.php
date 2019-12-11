<?php require_once('../../../private/initialise.php'); ?>
<?php require_once('../../../private/functions.php'); ?>
<?php
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/index.php'));
    }
    $id = $_GET['id'];
    $member = Member::find_by_id($id);
	
	if($member == false || (!am_officer() && !am_sysadmin() && get_session_id()!=$id)){
		redirect_to(url_for('/index.php'));
	}
?>

<?php $page_title = 'Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content" class="container mt-5 mb-5">
<?php if(!(am_officer() || am_sysadmin())){?>
  <a class="back-link" href="<?php echo url_for('/member/index.php'); // change to home page ?>">&laquo; Back to Member's Home page</a>
<?php } else { ?>
  <a class="back-link" href="<?php echo url_for('/officer/viewMembers.php'); ?>">&laquo; Back to List of Members</a>
  <?php }?>
<div class="member show"><br><br>

  <h1>Member: <?php echo h($member->full_name()); ?></h1><hr>
  <div class="attributes">
    <?php echo "First Name: " . h($member->fName) . "<br>"; ?>
    <?php echo "Last Name: " . h($member->lName) . "<br>"; ?>
    <?php echo "Address: " . h($member->address) . "<br>"; ?>
    <?php echo "Phone Number: " . h($member->phoneNum) . "<br>"; ?>
    <?php echo "Gender: " . h($member->gender) . "<br>"; ?>
    <?php echo "Date of Birth: " . h($member->dob) . "<br>"; ?>
    <?php echo "Rating: " . h($member->rating) . "<br>"; ?>
    <?php echo "Role: " . h($member->role) . "<br>"; ?><br>
    <?php 
      if(get_session_id()==$id){
    ?>
    <br>
    <div> 
    <h2>Tournament history</h2>
    <?php 
      $tournaments = Tournament::find_by_sql("SELECT tournaments.* from tournaments WHERE id in (select tournamentID from tournamentCompetitors WHERE competitorID=$id) ORDER BY signupDeadline desc");
      if (sizeof($tournaments) == 0){
        echo '<p style="padding-right: 5px;">No tournaments signed up to. Why not sign up one?</p>';
      }
      else {
        foreach ($tournaments as $tournament){
          echo "<br><h3>$tournament->name</h3>";
          $matchsql = "SELECT * from tournamentMatches WHERE (competitorID1=$id or competitorID2=$id) AND tournamentID=$tournament->id";
          $matches = Match::find_by_sql($matchsql);
          if (sizeof($matches) > 0) {
            echo '<table class="table table-hover">
              <tr>
              <th scope="col"> Matches Against </th>
              <th scope="col"> Match Date  </th>
              <th scope="col"> Outcome </th>
              </tr>';
            foreach ($matches as $m){
              $othercompetitorid = ($m->competitorID1 == $id)? $m->competitorID2 : $m->competitorID1;
              $othermember= Member::find_by_id($othercompetitorid);
              $outcome = ($m->winner == $id)? "WIN" : "LOSS";
              echo '<tr>
              <td>'.$othermember->full_name().'</td>
              <td>'.$m->matchDate.'</td>';
              if ($outcome == "WIN"){
                echo '<td><span style="color:green">'.$outcome.'</span></td>';
              } else {
                echo '<td><span style="color:red">'.$outcome.'</span></td>';
              }
              echo '</tr>';
            }
          }
          else {
            echo '<p>Signed up to this tournament. Greatness awaits!</p>';
          }
        }
      }
    ?>
    </table>
    <br><br>
    </div>
    <a class="action" href="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($member->id))); ?>"><button class="btn btn-primary">Edit Profile</button></a>
    <a class="action" href="<?php echo url_for('/member/profiles/delete.php?id=' . h(u($member->id))); ?>"><button class="btn btn-danger">Delete Profile</button></a>
    <?php 
      }
    ?>
  </div>

</div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
