<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/officer_header.php');
//include(SHARED_PATH . '/classes/member.class.php');
?>

<div class="container mt-5 mb-5">
    <h1>View Members</h1><br><br>
    
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Member ID</th>
            <th scope="col">Name</th>
            <th scope="col">Rating</th>     
			<th scope="col">Email</th>
			<th scope="col">&nbsp;</th>			
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