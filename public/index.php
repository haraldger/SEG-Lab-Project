
<?php 
include ('../private/shared/header.php');
include ('../private/shared/classes/news.class.php');
?>


<div class="container">
    <h2>KCLCS</h2>
    <img src="./static/chessSocietyLogo.jpg" alt="logo" width="10%" height="10%">
    <hr>
    <div class="row">
    <!--  style="width: 75%;" -->
        <div class="col-8">
        <img src="./static/chessBackground2.jpg" alt="chess" class="img-fluid" >
            <br>
            <a href = "mailto: strandhub@kclsu.org"><button type="button" class="btn btn-light">Email Us</button></a>
        
            <a href="http://facebook.com/groups/kclchess">Find Us on Facebook</a> 
        </div>
        <!--  style="width: 25%;" -->
        <div class="news-column">
            <h3>News</h3>
            <?php 
            // Get and sort all news objects
            $news = News::find_all();
            usort($news, function($a, $b){ 
                if($a->releasedate < $b->releasedate) return -1;
                elseif ($a->releasedate == $b->releasedate) return 0;
                else return 1; 
            });

            // Loop through all news, display non-expired ones
            foreach ($news as $newsItem) {
                if(strtotime($newsItem->expirydate) < time()) continue;
                // Title
                echo ("<h4>" . h($newsItem->title) . "</h4>
                    <p>" . h($newsItem->description) . "</p>
                    <small>" . h($newsItem->releasedate) . "</small>");
            }
            ?>
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
