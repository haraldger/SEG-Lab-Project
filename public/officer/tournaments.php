<?php require_once('../../private/initialise.php'); 

if(!(am_sysadmin() || am_officer())){
	redirect_to(url_for('../public'));
}

include(SHARED_PATH . '/officer_header.php');
include(SHARED_PATH . '/classes/tournament.class.php');
?>
    <div class="container mt-5 mb-5">
	<a class="back-link" href="<?php echo url_for('/officer/index.php'); ?>">&laquo; Back to Menu</a>
    <br>
    <br>
    <h1>Tournaments</h1>
    
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Tournament ID</th>
            <th scope="col">Name</th>
            <th scope="col">Signup Date</th>     
			<th scope="col">&nbsp;</th>
			<th scope="col">&nbsp;</th>			
        </tr>
    </thead>
        <?php

            $tournaments = Tournament::find_all();
            foreach($tournaments as $tournament){
                echo "<tr>";
                    echo "<th scope=\"row\">".$tournament->id."</th>";
                    echo "<td>$tournament->name</td>";
                    echo "<td>$tournament->signupDeadline</td>";
                    echo "<td> <a href=tournamentOrganisers.php?id=$tournament->id>Organisers</td>";
  				    echo "<td> <a href=tournamentEdit.php?id=$tournament->id>Edit</td>";
                    echo "<td> <a href=tournamentDelete.php?id=$tournament->id>Delete</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
	<br>
    <a href=tournamentCreate.php><button class="btn btn-primary">Create Tournament</button></a>
	<br>
    <br>
	
    
    </div>

<?php
	include(SHARED_PATH . '/footer.php');
?>
