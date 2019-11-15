<?php 
    //random data
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
   $eloRatings["person11"]= 1950;
   $eloRatings["person12"]= 1800;

   $distribution = array();
   //ranges for distribution
   //assumption:
   //main chunck of elo values lay in 1000-2000
    for($j = 1000; $j<2100; $j+=100){
        $distribution[$j] = 0;
    }
    $distribution[2100] = 0;
    //assume 2100 bracket is anything above 2000 elo rating (rare)

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
        case $score > 2000:
            $distribution[2100] += 1;
            break;                                   
    }
   }

   $width = 600;
   $height = 300;

   $padding = 30;

   $axisHeight = $height - ($padding * 2); //290
   $axisWidth = $width - ($padding * 2); //590

   $img = imagecreatetruecolor($width, $height);
   $black = imagecolorallocate($img, 0, 0, 0);
   $white = imagecolorallocate($img, 255, 255, 255);
   $red = imagecolorallocate($img, 255, 153, 153);
   $gray_dark = imagecolorallocate($img,0x7f,0x7f,0x7f);

   //background setup
   imagefill($img, 0, 0, $white);
   imagefilledrectangle($img,0,0,$width,$height,white);

   $maxRating = 0;

   foreach($distribution as $key => $value){
       $maxRating = max($maxRating, $value);
   }

   $numCols = count($distribution);
    
   $spaceBetweenCols = 30;
    $colWidth = ($axisWidth / $numCols)- $spaceBetweenCols;
   
   $i=0;
   
   foreach($distribution as $key => $value){
    $column_height =  $axisHeight * ($value/ $maxRating)- ($padding);
    $x1 = ($i* $spaceBetweenCols) + ($i* $colWidth) + $padding;
    $y1 = $height -$padding;
    $x2 = $x1 + $colWidth;
    $y2 = $axisHeight-$column_height;

    imagerectangle($img, $x1, $y1, $x2, $y2, $black);
    $i++;
   }

   $minX = $padding;
   $minY = $padding;
   $maxY = $height - $padding;
   $maxX = $width - $padding;

   //x and y axis
    imageline($img, $minX, $minY, $minX, $maxY, $gray_dark);
    imageline($img, $minX, $maxY, $maxX, $maxY, $gray_dark);

    //horixontal grids
    for($i =$maxY; $i>$minY; $i--){
        if($i%100 ==0){
            imageline($img, $minX, $i, $maxX, $i, $gray_dark);
            //label

        }
        else if ($i%50 ==0){
            imageline($img, $minX, $i, $minX + 5, $i, $gray_dark);
        }
        else{

        }
    }


    //headers
    //Graph Title
    $titleX = $width /2 - 50;
    $titleY = $padding /2 -10;
    imagestring ($img, 5, $titleX , $titleY , "Members Elo Distribution" , $gray_dark); 
    imagestring ($img, 2,  $titleX, ($height - ($padding/2)) , "Elo Ratings" , $gray_dark);
    imagestringup($img, 2, ($padding/2) , ($height/2) , "Frequency" , $gray_dark);  

    header('Content-Type: image/png');
    imagepng($img);
    imagedestroy($img);
    
    

?>



