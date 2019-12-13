<?php 
require_once('../private/initialise.php');
$page_title = "News";
require_once('../private/shared/header.php');
?>

<div class="container mt-5 mb-5">
	<h2>KCLCS</h2>
    <img src="./static/chessSocietyLogo.jpg" alt="logo" width="10%" height="10%">
    <hr>
    <h3>News</h3>
    <?php
    $news = News::find_all();

    // Fetch non-expired news
    for ($i=0; $i < count($news); $i++) { 
    	if(strtotime($news[$i]->expiryDate) < time()) {
     		unset($news[$i]);
   		}
    }

    // Sort news for release date
    usort($news, function($a, $b){
    	if($b->releaseDate < $a->releaseDate) return -1;
    	elseif ($a == $b) return 0;
    	else return 1;
    });

    // display the news items
    foreach ($news as $newsItem) {
        echo("
            <h4>" . h($newsItem->title) . "</h4>
            <p>" . h($newsItem->description) . "</p>
            ");
        if($newsItem->releaseDate){
            $date = date_create_from_format('Y-m-d H:i:s', $newsItem->releaseDate);
            echo("<small><i>" . h($date->format('Y-m-d')) . "</i></small>");
        } else {
            echo("<small>Unknown release date</small>");
        }
        echo ("<hr>");
    }
    ?>
</div>

<?php include '../private/shared/footer.php' ?>