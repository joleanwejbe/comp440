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
//waa a, awda ,asda ,,
function &Returnarrayoftags($str , $length)
{   $array = array();
    $prevspot = 0;
    $count=0; 
    //aa,zz,qq
    while($count<$length)
    {
        if($str[$count]==',')
        {
            if($prevspot!=0){
               // $loclstr= trim(substr($str, $prevspot+1, (($count- $prevspot)) )),"," ); 
                if(trim(trim(substr($str, $prevspot+1, (($count- $prevspot)) ),",")) !="")
             array_push($array, trim(substr($str, $prevspot+1, (($count- $prevspot)) ),",")  ); 
            
            }
          else
          {
            if(trim(trim(substr($str, $prevspot+1, (($count- $prevspot)) ),",")) !="")
          array_push($array, trim(substr($str, $prevspot, (($count- $prevspot)) ),",") ); 
          
            }
          $prevspot= $count; 
        }
        else
        {   $char = $str[$count]; 
            //echo"failure your char is a $char "  ;
            //echo '<br>';

        }



        $count++;

        if($count>=$length){
            if(trim(trim(substr($str, $prevspot, (($count- $prevspot)) ),",")) !="")
            array_push($array, trim(substr($str, $prevspot, ($count- $prevspot)),"," ));  
        }
    }

    if($prevspot==0)
    array_push($array, $str);

   
    
    //,apples, apple, cool, ,.,,
    // eggs, are , good, forhealth   ,
    //,asdaq,ddd,zzzz,x,c,vvv,,, fg
    //  foreach ($array as $value) {
    //      echo "$value ";
    //      echo '<br>'; 
    //    }
       return $array; 
      
    // if(substr($str, $prevspot, $count - $prevspot))
    //         { $stt= substr($str, $prevspot, $count- $prevspot);
    //             echo"success $stt";
    //             echo '<br>';
    //         }
    //         else
    //         {

    //             echo"failure";
    //             echo '<br>';
    //         }
}