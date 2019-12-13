<?php require_once('../../../private/initialise.php'); 
  
  if(!isset($_GET['id'])) {redirect_to(url_for('/index.php'));}
  $id = $_GET['id'];
  $member = Member::find_by_id($id);
	
	if($member == false || (!am_officer() && !am_sysadmin() && get_session_id()!=$id)){
		redirect_to(url_for('/index.php'));
  }
  
 $page_title = 'Profile';
 include(SHARED_PATH . '/header.php'); ?>

<div id="content" class="container mt-5 mb-5">
  <?php if(!(am_officer() || am_sysadmin())){?>
    <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Member's Home page</a>
    <?php } else { ?>
    <a class="back-link" href="<?php echo url_for('/officer/members/viewMembers.php'); ?>">&laquo; Back to List of Members</a>
  <?php }?>

  <div class="member show"><br><br>
  <h1>Member: <?php echo $member->full_name(); ?></h1><hr>
  <div class="attributes">
      <?php
        echo "First Name: ".$member->fName."<br>";
        echo "Last Name: ".$member->lName."<br>";
        echo "Address: ".$member->address."<br>";
        echo "Phone Number: ".$member->phoneNum."<br>";
        echo "Gender: ".$member->gender."<br>";
        echo "Date of Birth: ".$member->dob."<br>";
        echo "Rating: ".$member->rating."<br>";
        echo "Role: ".$member->role."<br><br><br>";
        if(get_session_id()==$id){
      ?>
    
  <div> 
    <h2>Tournament history</h2>
    <?php 
      $tournaments = Member::find_by_id($id)->getTournaments();
      if (sizeof($tournaments) == 0){echo '<p style="padding-right: 5px;">No tournaments signed up to. Why not sign up one?</p>';} else {
        foreach ($tournaments as $tournament){
          echo "<br><h3>$tournament->name</h3>";
          $matchsql = "SELECT * from tournamentMatches WHERE (competitorID1=$id or competitorID2=$id) AND tournamentID=$tournament->id ORDER BY roundNum DESC";
          $matches = Match::find_by_sql($matchsql);
          if (sizeof($matches) > 0) {
            foreach ($matches as $m){
              $othercompetitorid = ($m->competitorID1 == $id)? $m->competitorID2 : $m->competitorID1;
              $othermember= Member::find_by_id($othercompetitorid);
              $outcome = ($m->winner == $id)? "WIN" : "LOSS";

			        echo '<table class="table table-hover"><thead><tr><th scope="col"> Matches Against </th><th scope="col">Match Date</th><th scope="col"> Outcome </th></tr></thead>';
              echo '<tbody><tr><td>'.$othermember->full_name().'</td><td>'.$m->matchDate.'</td>';
              if ($outcome == "WIN"){ echo '<td><span style="color:green">'.$outcome.'</span></td>';} 
              else { echo '<td><span style="color:red">'.$outcome.'</span></td>';}
              echo '</tr></tbody></table>';
            }
          } else {
            echo "<p>Signed up to this tournament. Greatness awaits!</p><br><br>";
          }
        }
      }
    ?>
    </div>
    <a class="action" href="<?php echo url_for('/member/profiles/edit.php?id=' . h(u($member->id))); ?>"><button class="btn btn-primary">Edit Profile</button></a>
    <a class="action" href="<?php echo url_for('/member/profiles/delete.php?id=' . h(u($member->id))); ?>"><button class="btn btn-danger">Delete Profile</button></a>
    <?php } ?>
  </div>
</div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
