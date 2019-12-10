<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/officer_header.php');

$sys_admin = am_sysadmin();
?>

<div class="container mt-5 mb-5">
    <?php 
        if($sys_admin){  
    ?>
        <h1>View Members & Officers</h1><br><br>
    <?php  } else {?>
        <a class="back-link" href="<?php echo url_for('/officer/index.php'); ?>">&laquo; Back to Menu</a>
	    <br>
	    <br>
        <h1>View Members</h1><br><br>
     <?php }?>

    <table class="table">
    <thead>
        <tr>
            <th scope="col">Member ID</th>
            <th scope="col">Name</th>
            <th scope="col">Rating</th>     
			<th scope="col">Email</th>
			<th scope="col">&nbsp;</th>	
            <?php if($sys_admin){ ?><th scope="col">&nbsp;</th>	<?php }?>	
        </tr>
    </thead>
        <?php

            $members = Member::find_all();
            foreach($members as $member){
                echo "<tr>";
                    echo "<th scope=\"row\">".$member->id."</th>";
                    echo "<td>$member->fName $member->lName</td>";
                    echo "<td>$member->rating</td>";
                    echo "<td>$member->email</td>";
                    echo "<td> <a href=../member/profiles/index.php?id=$member->id>View Profile</td>";
                    if($sys_admin){
                        echo "<td>"; 
                        if($member->role == "Member"){
                            
                            echo "<a href=roleEdit.php?id=$member->id>Promote";
                        }
                        else if($member->role == "Officer"){
                            echo "<a href=roleEdit.php?id=$member->id>Demote";
                        }
                        else {
                            echo "System Admin";
                        }
                        echo "</td>";	
                    }
                echo "</tr>";
            }
        ?>
    </table>
    
	<br>
	<br>
    <br>
	
    
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>