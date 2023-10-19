
<?php
class Encryptor {
    function __construct(){

    }
    function encrypt($msg){
        $charContainer =[] ;
        $cypher ="";
        if (strlen($msg)==1){
            return $msg ; 
        }
        $i = 0 ; $j = 1 ; 
        while($j < strlen($msg)){  // A B C D
            $temp = $msg[$i] ;
            $msg[$i] = $msg[$j] ; 
            $msg[$j] = $temp ;
            $charContainer[$i] = $msg[$i];
            $charContainer[$j] = $msg[$j];
            $i = $j+1 ;
            $j=$i+1 ;
        }
        if(strlen($msg) %2 != 0){
            $charContainer[strlen($msg)-1] = $msg[-1] ;
        }
        foreach($charContainer as $index => $char){
            $cypher = $cypher . $char .(string) $index ;
        }
        return strrev($cypher) ; 
    }
    function decrypt($cypherMsg){
        $cypherMsg=strrev($cypherMsg) ;
        $i = 0 ; $j = 1 ; 
        
        //if(strlen($cypherMsg) %2 == 0){
            $msgContainer = [] ;
            $plainMsg ='';
            while($j < strlen($cypherMsg)-1){
                strpos($cypherMsg , strval($i)) == true ? $cypherMsg = str_replace(strval($i) , "" ,$cypherMsg)  : false ; 
                strpos($cypherMsg , strval($j)) == true ? $cypherMsg = str_replace(strval($j) , "" ,$cypherMsg)  : false ; 
                $temp = $cypherMsg[$i] ;
                $cypherMsg[$i] = $cypherMsg[$j] ; 
                $cypherMsg[$j] = $temp ;
                array_push($msgContainer ,$cypherMsg[$i] );
                array_push($msgContainer ,$cypherMsg[$j] );
                $i = $j+1 ; 
                $j=$i+1 ;
            } 
            //$i++;
            
            echo strlen($cypherMsg)." ".$i."<br>";
            //if(strlen($cypherMsg) %2 == 0){
                $i == strlen($cypherMsg)-1 ? array_push($msgContainer ,$cypherMsg[$i] ) : false ; 
            //}
            foreach ($msgContainer as $char){
                $plainMsg = $plainMsg . $char;
            }
            return $plainMsg;
            
        //}
       /* else
       {
            
            while($j < strlen($cypherMsg)){
                strpos($cypherMsg , strval($i)) == true ? $cypherMsg = str_replace(strval($i) , "" ,$cypherMsg)  : false ; 
                strpos($cypherMsg , strval($j)) == true ? $cypherMsg = str_replace(strval($j) , "" ,$cypherMsg)  : false ; 
                $temp = $cypherMsg[$i] ;
                $cypherMsg[$i] = $cypherMsg[$j] ; 
                $cypherMsg[$j] = $temp ;
                $i = $j+1 ; 
                $j=$i+1 ;
            }            

        }*/
        $decryptedMsg = $cypherMsg ; 
        return $decryptedMsg ;
    }
}
/*
$enc = new Encryptor();
$text =
'hello there are you ok';
$t = 'hel01006059030';

echo "text : ".$text . "<br>";
$cypher=$enc->encrypt($text);
echo $cypher ." ".strlen($cypher). "<br>";
echo $enc->decrypt($cypher);*/