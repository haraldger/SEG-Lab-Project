<?php 

    
    require_once('../initialise.php'); 
    $members = Member::find_all();
    
    
    foreach($members as $member){
         $eloRatings[$member->fName] = $member->rating;
    }
    // example data for testing purposes
    /*
   $eloRatings["Jon Smith"]= 1063;
   $eloRatings["Person2"]= 1151;
   $eloRatings["person3"]= 1840;
   $eloRatings["person4"]= 1777;
   $eloRatings["person5"]= 1915;
   $eloRatings["person6"]= 1777;
   $eloRatings["person7"]= 1520;
   $eloRatings["person8"]= 1585;
   $eloRatings["person9"]= 1521;
   $eloRatings["person10"]= 1447;
   $eloRatings["person11"]= 1700;
   $eloRatings["person12"]= 1500;
   $eloRatings["person13"]= 1521;
   $eloRatings["person14"]= 1234;
   $eloRatings["person15"]= 1700;
   $eloRatings["person16"]= 1342;
   $eloRatings["person17"]= 1540;
   $eloRatings["person18"]= 1244;
   $eloRatings["person19"]= 1320;
   $eloRatings["person20"]= 1490;
   $eloRatings["person21"]= 2030;
*/
   $distribution = array();
   //ranges for distribution
   //assumption:
   //main chunck of elo values lay in 1000-2000 (Source: Wiki and online)
    for($j = 1000; $j<2100; $j+=100){
        $distribution[$j] = 0;
    }
    $distribution[2100] = 0;
    //assume 2100 bracket is anything above 2000 elo rating (rare)

    //seperate all Elo ratings into 1000's range
    //Eg. 1000-2000, 2000-3000.... 
   foreach($eloRatings as $person => $score){
    switch ($score) {
        case $score <= 1000:
            $distribution[1000] += 1;
            break;
        case $score <= 1100:
            $distribution[1100] += 1;
            break;
        case $score <= 1200:
            $distribution[1200] += 1;
            break;
        case $score <= 1300:
            $distribution[1300] += 1;
            break;            
        case $score <= 1400:
            $distribution[1400] += 1;
            break; 
        case $score <= 1500:
            $distribution[1500] += 1;
            break;  
        case $score <= 1600:
            $distribution[1600] += 1;
            break;
        case $score <= 1700:
            $distribution[1700] += 1;
            break;
        case $score <= 1800:
            $distribution[1800] += 1;
            break;    
        case $score <= 1900:
            $distribution[1900] += 1;
            break;              
        case $score <= 2000:
            $distribution[2000] += 1;
            break;    
        case $score <= 2100:
            $distribution[2100] += 1;
            break;                                   
    }
   }
   
   //height and width of the pane of the graph
   $width = 600;
   $height = 300;
   //padding to create axis inside pane
   $padding = 30;
   //axis height
   $axisHeight = $height - ($padding * 2); //290
   $axisWidth = $width - ($padding * 2); //590
   
   
   //colours and image set up
   $img = imagecreatetruecolor($width, $height);
   $black = imagecolorallocate($img, 0, 0, 0);
   $white = imagecolorallocate($img, 255, 255, 255);
   $red = imagecolorallocate($img, 255, 153, 153);
   $gray_dark = imagecolorallocate($img,0x7f,0x7f,0x7f);
   $nice_blue = imagecolorallocate($img,0,206,209);
   $almost_black_blue = imagecolorallocate($img,0,0,51);
   $white_pink = imagecolorallocate($img,255,102,178);

   
   //background setup
   imagefill($img, 0, 0, $white);
   imagefilledrectangle($img,0,0,$width,$height,$white);

   //find the max rating (to set as max height of the graph)
   $maxRating = 0;
   foreach($distribution as $key => $value){
       $maxRating = max($maxRating, $value);
   }
   //numCols is the number of colums in distribution
   $numCols = count($distribution);
    
   $spaceBetweenCols = 30;
   $colWidth = ($axisWidth / $numCols)- $spaceBetweenCols;
   
   //creating the bars and the numbering
   $i=0;
   foreach($distribution as $key => $value){
    $column_height =  $axisHeight * ($value/ $maxRating)- ($padding);
    $x1 = ($i* $spaceBetweenCols) + ($i* $colWidth) + $padding;
    $y1 = $height -$padding;
    $x2 = $x1 + $colWidth;
    $y2 = $axisHeight-$column_height;
    //bar
    imagefilledrectangle($img, $x1, $y1, $x2, $y2, $nice_blue);
    //bar lines and labels
    $centreBarX = $x1 + ($x2-$x1)/2 - 1;
    $centreBarY = $y1 + ($y2-$y1)/2;
    imagestring ($img, 2,  $x1, $y1, $key, $gray_dark);
    // imagestring ($img, 2,  $centreBarX, $centreBarY, $value, $white_pink);
    imageline($img, $padding, $y2, $padding + 5,  $y2, $gray_dark);
    $i++;
   }
   //padding and axis variables
   $minX = $padding;
   $minY = $padding;
   $maxY = $height - $padding;
   $maxX = $width - $padding;

    //x and y axis
    imageline($img, $minX, $minY, $minX, $maxY, $gray_dark);
    imageline($img, $minX, $maxY, $maxX, $maxY, $gray_dark);

    //horixontal lines on x axis
    for($i =$maxY; $i>$minY; $i--){
        if($i%50 ==0){
            imageline($img, $minX, $i, $maxX, $i, $gray_dark);
            //label
        }
        else if ($i%25 ==0){
            // imageline($img, $minX, $i, $minX + 5, $i, $gray_dark);
        }
        else{

        }
    }

    
    //headers and graph titles
    $titleX = $width /2 - 50;
    $titleY = $padding /2 -10;
    //the title below is commented out because gdf font is horrible
    // imagestring ($img, 5, ($titleX-15) , $titleY , "Members Elo Distribution" , $almost_black_blue); 
    imagestring ($img, 2,  ($titleX+25), ($height - ($padding/2)) , "Elo Ratings" , $gray_dark);
    imagestringup($img, 2, 5 , ($height/2) , "Frequency" , $gray_dark);  

    header('Content-Type: image/png');
    imagepng($img);
    imagedestroy($img);
?>



