<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

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
            <th scope="col">Profile</th>	
			<th scope="col">Ban User</th>	
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
                    if($member->role == "Member"){
                        echo "<td> <a style='color:red;' href=../officer/memberBan.php?id=$member->id>Block</td>";
                    }
                    else{
                        echo "<td> </td>";
                    }
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
    <h2 class=" mx-sm-3">Ban User By Email</h2><br>
    <form class="form-inline" action="<?php echo url_for('/officer/banByEmail.php') ?>" method="post">
        <div class="form-group mx-sm-3 mb-2">
            <label class="sr-only">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@kcl.ac.uk">
        </div>
        <button type="submit" class="btn btn-danger mb-2">Ban this user</button>
    </form>
    
	<br>
	<br>
    <br>
	
    
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>