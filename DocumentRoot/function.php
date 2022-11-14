<?php 


function random_num($length)
{
    $text =""; 
    if($length<5)
    {
        $length = 5;

    }
    $len  = rand(4,$length);
    for ($i=0; $i <$len ; $i++) { 
        # code...
        $text .= rand(0,9);
    }
    return $text; 
}



function CanIPostABlog($DatesnNames, $Currentuser )
{
    
    $count = 0; 
    //echo $count; 
    foreach($DatesnNames as $row) {
        if($row['created_by']==$Currentuser)
        $count++; 

        //echo $count; 
        
    }
    if($count==2)
    return false; 
    else
    return true; 

}