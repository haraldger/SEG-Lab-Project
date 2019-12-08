
<?php 
require_once('../private/initialise.php');
$page_title = "Welcome to KCL Chess Society";             
require_once('../private/shared/header.php');
require_once('../private/shared/classes/news.class.php');
?>

<div class="container mt-5 mb-5">
    <h2>KCLCS</h2>
    <img src="./static/chessSocietyLogo.jpg" alt="logo" width="10%" height="10%">
    <hr>
    <div class="row">
        <div class="col-8">
        <img src="./static/chessBackground2.jpg" alt="chess" class="img-fluid" >
        </div>
        <div class="col-4">
            <h3>News</h3>
            <?php
            $sampleNews = News::find_all()[0];
            echo("
                <h4>" . h($sampleNews->title) . "</h4>
                <p>" . h($sampleNews->description) . "</p>
                ");
            if($sampleNews->releaseDate){
                $date = date_create_from_format('Y-m-d H:i:s', $sampleNews->releaseDate);
                echo("<small><i>" . h($date->format('Y-m-d')) . "</i></small>");
            } else {
                echo("<small>Unknown release date</small>");
            }
            ?>
            <br><br>
            <a href="../public/news.php"><i>More...</i></a>
        </div>
    </div><br>

    <hr>
    <div class="row" >
        <h4>Who we are</h4>
        <p>Whether you’re the next Magnus Carlsen or a complete beginner just hoping to learn the rules of chess, the chess society has something for you. In our relaxed weekly sessions beginners will be able to learn the rules and basic strategies of the game, while more experienced players can test their skills against worthy opposition.
        <br>
        We will also hold regular chess-themed socials and events, so make sure to join our facebook group to be first to hear about them!</p>
        <b>Our sessions are held every Tuesday in room 6.04 of Bush House (South-East Wing), starting at 6:30 PM</b>
        <p>No elections are currently running</p>
    </div>
</div>


<?php include '../private/shared/footer.php' ?>
