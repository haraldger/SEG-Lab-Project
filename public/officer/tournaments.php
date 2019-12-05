<?php require_once('../../private/initialise.php'); 

include(SHARED_PATH . '/officer_header.php');
include(SHARED_PATH . '/classes/tournament.class.php');
?>
    <div class="container mt-5 mb-5">
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
            $query = "SELECT * FROM tournaments";
			$connection = db_connect();
            $result_set = mysqli_query($connection, $query);
    
            while($tournaments = mysqli_fetch_assoc($result_set)){
                echo "<tr>";
                    echo "<th scope=\"row\">".$tournaments["id"]."</th>";
                    echo "<td>".$tournaments["name"]."</td>";
                    echo "<td>".$tournaments["signupDeadline"]."</td>";
                    echo "<td> <a href=tournamentEdit.php?id=".$tournaments["id"].">Edit</td>";
                    echo "<td> <a href=tournamentDelete.php?id=".$tournaments["id"].">Delete</td>";
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
    mysqli_free_result($result_set);
    db_disconnect($connection)
?>
