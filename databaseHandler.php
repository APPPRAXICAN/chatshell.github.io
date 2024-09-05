<?php
class databaseHandler {
    private $srvr = 'localhost';
    private $usrname = 'root';
    private $password = '';
    private $databaseName ='chatroom';
    private $con ; 
    function __construct()
    {
        try {
            $this->con = new \mysqli($this->srvr, $this->usrname, $this->password, $this->databaseName);
            if ($this->con){
            }
        }catch(\Exception $e){
            die("Error: " . $e->getMessage());
        }
    }
    function  createNewUser(string $userName , string $userPassword  , string $path , int $gender , int $age){
        $sql ="insert into Accounts (userName ,userPassword, profileImagePath , gender , age) values( '".$userName."' , '".$userPassword."', "."'".$path."' ,".$gender."
        , ".$age." );";
        if ($this->con->query($sql) === TRUE) {
          //  echo "<br><br><br>New record created successfully";
          } else {
            echo "<br><br><br>Error: " . $sql . "<br>" . $this->con->error;
          }
    }
    function isUser(String $userName ,string $userPassword):bool{
        $sql="select userName , userPassword from Accounts where userName = '".$userName."' and userPassword ='".$userPassword."' ;";
        $result = $this->con->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                //var_dump($row);
                 $name = $row["userName"] ;
                 $password = $row["userPassword"];
            }
            if($name == $userName && $password == $userPassword){
                return TRUE;
            }
        }
        return false;
    }
    function isUserAlreadyExists(String $userName):bool{
        $sql = "select userName from accounts where userName = '".$userName."';" ;
        $result = $this->con->query($sql);
        if($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                $name = $row['userName'];
            }
            if($name == $userName){
                return true;
            }
        }
        return false; 
    }
    function getUserNameByID($ID){
        $query= "select userName from accounts where id =".$ID.";";
        $result=$this->con->query($query);
        if($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                return $row['userName'];
            }
        }
    }
    function getUserIdByName(String $name):int{
            $sql ="select id from accounts where userName ='".$name."';";
            $result = $this->con->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                   
                   return $row['id'];
                }
            }
            return -1 ;//userNOtFound , userDublicated dedicted
    }
    private function swap (&$x , &$y){
        $t = $x ;
        $x = $y ;
        $y = $t ;
    }
    private function partition ($start , $end , $arr){
        $pivot = $arr[$end] ; 
        $i  = $start -1 ;
        for($j = $start ; $j <= $end ; $j++){
            if($arr[$j] <= $pivot){
                $i++;
                $this->swap($arr[$j],$arr[$i]);
            }
        }
        $i++;
        $this->swap($arr[$i],$arr[$end]);
        return $i;
    }
    public function quickSort ($start , $end , $arr){// use it with count(arr) -1
       if($end <= $start)return ; 
       $pivot = $this->partition($start , $end,$arr);
       $this->quickSort($start , $pivot-1 , $arr);
       $this->quickSort($pivot+1 , $end , $arr);
    }
    function msgCapture(String $msg ,string $userName , string $roomName){
            $sql ="insert into chatMsg (msg,users_id,room_id) "."values('".$msg."'".",".$this->getUserIdByName($userName)." , ".$this->getRoomID($roomName).");";
            if ($this->con->query($sql) === TRUE) {
         //       echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->con->error;
            }    
       
    }
    function getMsgSet($roomName){
        $query = "
            select msg  , userName from chatMsg join accounts
            on chatMsg.users_id = accounts.id
            where room_id= ".$this->getRoomID($roomName)." 
            order by chatMsg.id asc ;
        ";
        $list = [];
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
               array_push($list , [$row['userName'] ,$this->getUserProfileImage($row['userName']) ,$row['msg']]);
            }
        }
        return $list;
    }
    function numberOFRooms(string $userName):int {
        $sql = "select count(room_id) from Accounts_rooms where account_id =".$this->getUserIdByName($userName).";";
        $result = $this->con->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                return $row['count(room_id)'];
            }
        }
        return -1;

    }
    function userUpdatePassword($userName , string $password){
        $query="
        update accounts
        set userPassword ='".$password."' 
        where userName ='".$userName."';
        ";
        $this->con->query($query);
    }
    function userUpdateAge($userName , int $age){
        $query="
        update accounts
        set age =".$age."
        where userName ='".$userName."';
        ";
        $this->con->query($query);
    }
    function getUserPassword($userName){
        $query="
            select userPassword from accounts where id = ".$this->getUserIdByName($userName)." ;
        ";
        $result = $this->con->query($query);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                return $row['userPassword'];
            }
        }
    }
    function setUserStatus($userName,$status){
        $query ="insert into log (userStatus,userID) values(".$status.",".$this->getUserIdByName($userName).");";
        if($this->con->query($query)){
           // echo "<br><br><br>record added successfully";
        }else{
            //echo  "<br><br><br>Error: " . $query . "<br>" . $this->con->error;;
        }
        
    }
    function setUserProfileImage($userName , $path){
        $query = "insert into Accounts (profileImagePath) values('$path') where userName = '$userName'";
        $this->con->query($query);
        if($this->con->query($query)=== true){
            echo 'new record created successfully';
        }
        else{
            echo 'error : '.$query."<br>".$this->con->error;
        }
    }
    function getUserProfileImage($userName):String{
        $query="select profileImagePath from Accounts where userName = '$userName';";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                return $row['profileImagePath'];
            }
        }
        return '';
    }
    function getRoomID($roomName):int{
        $query ="select id from rooms where roomName ='".$roomName."';" ;
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                return $row['id'];
            }
        }
        return -1; 
    }
    function makeRoom(string $roomName ,int $roomKey ,string $userName ,int $capacity){
        $query1 = "insert into rooms (roomName,roomKey,AdminID,capacity) values ( '".$roomName."', ".$roomKey.", ".$this->getUserIdByName($userName).", ".$capacity." );";
        $this->con->query($query1);
        $query2 = "insert into Accounts_rooms( account_id , room_id ) values (".$this->getUserIdByName($userName).",".$this->getRoomID($roomName).");";
        $this->con->query($query2);
    }
    function userLogin(string $userName){
        if($this->isUserAlreadyExists($userName)){
            $query = "insert into log (userID , userStatus) values(".$this->getUserIdByName($userName).", 1);";
            $this->con->query($query);
        }
    }
    function userLogout(string $userName){
        if($this->isUserAlreadyExists($userName)){
            $query = "insert into log (userID , userStatus) values(".$this->getUserIdByName($userName) .", 0);";
            $this->con->query($query);
        }
    }
    function getUserStatus(string $userName){
        if($this->isUserAlreadyExists($userName)){
            $query = "select userStatus from log where userID = ".$this->getUserIdByName($userName)." ORDER BY id DESC LIMIT 1;";
            $result = $this->con->query($query);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    return $row['userStatus'];
                }
            }
            return -1;
        }
    }
    function getRoomsNameList(String $userName){
        if($this->isUserAlreadyExists($userName)){
            $query ="select roomName from rooms where AdminID = ".$this->getUserIdByName($userName).";";
            $result = $this->con->query($query);
            $nameList =array() ;
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                   array_push($nameList,$row['roomName']) ;
                }
                
            }
           return $nameList ;
        }
    }
    function isRoomAlreadyExists(string $roomName ,string $adminName):bool{
        $query ="select roomName from rooms where roomName = '".$roomName."' and AdminID =".$this->getUserIdByName($adminName).";";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row =$result->fetch_assoc()){
                if($row['roomName'] == $roomName){
                    return true;
                }
            }
        }
        return false;
    }
    function getNameSet($userName)//getting all userNames in DB except the user himself (used for searching)
    {
        $query = "select userName from accounts";
        $result =$this->con->query($query);
        $nameSet = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if($userName == $row['userName'])continue;
                array_push($nameSet,strtolower($row['userName']));
            }
        }
        return $nameSet;
    }
    function getUserAge($userName):string{
        $query = "select age from accounts where userName = '".$userName."' ;";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                    return $row['age'];
            }
        }
        return "";
    }
    function getUserGender($userName):string{//0 for male and 1 for female
        $query= "select gender from accounts where userName = '".$userName."' ;";
        $result = $this->con->query($query);
        $gender= -1; 
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $gender= $row['gender'];
            }
            if($gender == 0){
                return 'Male';
            }
            if($gender == 1){
                return 'Female';
            }
        }
        return 'Wrong';
    }
    function sendFriendRequest($senderName , $recieverName){
        $query = "insert into friend_request(senderID , recieverID) values(".$this->getUserIdByName($senderName).",".$this->getUserIdByName($recieverName).");";
        $this->con->query($query);
    }
    function numOfFriendRequestsForReciever($recieverName){
        $query = "
            select count(id) from friend_request where recieverID=".$this->getUserIdByName($recieverName)." ;
        ";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                return $row['count(id)'];
            }
        }
        return -1 ;
    }
    function sendRoomRequest($roomName , $recieverName){
        $query = "
                insert into rooms_request (roomID,recieverID) values (".$this->getRoomID($roomName)." , ".$this->getUserIdByName($recieverName).") ; 
        ";
        $this->con->query($query);
    }
    function numOfRoomRequestsForReciever($recieverName){
        $query ="
                select count(id) from rooms_request where recieverID = ".$this->getUserIdByName($recieverName)."
        ";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                return $row["count(id)"];
            }
        }
        return -1 ;
    }
    function deleteOldFriendRequest($senderName,$recieverName){
        $query = "
        delete from friend_request where senderID=".$this->getUserIdByName($senderName)." and recieverID=".$this->getUserIdByName($recieverName)." ;
        ";
        $this->con->query($query);
    }
    function deleteOldRoomRequest($roomName , $recieverName){
        $query = "
        delete from rooms_request where roomID=".$this->getRoomID($roomName)." and recieverID=".$this->getUserIdByName($recieverName)." ;
        ";
        if($this->con->query($query) === true){
            echo 'success';
        }    
        else{
            echo 'error';
        }
    }
    function isFriendRequestAlreadySent($senderName , $recieverName):bool{
        $query="select senderID from friend_request where recieverID=".$this->getUserIdByName($recieverName) ;
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if($this->getUserIdByName($senderName) == $row['senderID']){
                    return true;
                }
            }
        }
        return false;
    }
    function isRoomRequestAlreadySent ($roomName, $recieverName):bool{
        $query="select roomID from rooms_request where recieverID=".$this->getUserIdByName($recieverName);   
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row= $result->fetch_assoc()){
                if($this->getRoomID($roomName)==$row['roomID']){
                    return true;
                }
            }
        }
        return false;
    }
    function isAlreadyfriend($friendName , $userName):bool{
        $query="select friends_id from friends where user_id = ".$this->getUserIdByName($userName)." and friends_id = ".$this->getUserIdByName($friendName).";";
        $result = $this->con->query($query);
        if($result->num_rows>0){
            return true;
        }
        return false ;
    }
    function removeFriend($friendName , $userName){
        $query1 = "delete from friends where user_id = ".$this->getUserIdByName($userName)." and friends_id = ".$this->getUserIdByName($friendName);
        $query2 = "delete from friends where user_id = ".$this->getUserIdByName($friendName)." and friends_id = ".$this->getUserIdByName($userName);
        $this->con->query($query1);
        $this->con->query($query2);
    }
    function getRoomCapacity($roomName , $adminName):int{
        $query = "select capacity from rooms where roomName ='".$roomName."' and AdminID =".$this->getUserIdByName($adminName).";";
        $result = $this->con->query($query);
       // var_dump($result);
        if($result->num_rows > 0){
         //   var_dump($result);
            while($row = $result->fetch_assoc()){
                return $row['capacity'];
            }
        }
        return -1; 
    }
    function numOFRoomParticipants($roomName):int{
        //$query ="select count(room_id) from accounts_rooms where room_id =".$this->getRoomID($roomName)." ;";
        $query ="select count(account_id) from accounts_rooms where room_id =".$this->getRoomID($roomName)." ;";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            //    return $row['count(room_id)'];
                return $row['count(account_id)'];
            
            }
        }
        return -1;
    }
    function getNumberOfFreePlaces($roomName , $adminName){
        $capacity = $this->getRoomCapacity($roomName , $adminName);
        $filledPlaces =  $this->numOFRoomParticipants($roomName);
        return $capacity - $filledPlaces ; 
    }
    function getFriendRequestSet($recieverName){
        $query = "select senderID from friend_request where recieverID =".$this->getUserIdByName($recieverName).";" ;
        $result = $this->con->query($query);
        $senderSet = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                //array_push($senderSet , $this->getUserNameByID($row['senderID']) );
                $senderSet[$this->getUserNameByID($row['senderID'])] = $this->getUserProfileImage($this->getUserNameByID($row['senderID']));
            }
        }
        return $senderSet ; 
    }
    function getRoomRequestSet($recieverName){
        $query = "
        
        select  roomName from rooms join rooms_request 
        on rooms.id = rooms_request.roomID 
        where rooms_request.recieverID =".$this->getUserIdByName($recieverName)." ;

        ";
        $result=$this->con->query($query);
        $requests = [];
        $profiles = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(isset($requests[$this->getUserNameByID($this->getAdminIDOfRoom($row['roomName']))])){
                    array_push($requests[$this->getUserNameByID($this->getAdminIDOfRoom($row['roomName']))] ,$row['roomName']);
                }   
                else{
                    $requests[$this->getUserNameByID($this->getAdminIDOfRoom($row['roomName']))] = [$row['roomName']] ;
                    $profiles[$this->getUserNameByID($this->getAdminIDOfRoom($row['roomName']))]=$this->getUserProfileImage($this->getUserNameByID($this->getAdminIDOfRoom($row['roomName'])));
                }
            }
        }
        $requestsWithProfiles = ['profiles' => $profiles , 'requests' => $requests];
        return $requestsWithProfiles; 
    }
    function getAdminIDOfRoom($roomName){
        $query = "select AdminID from rooms where roomName = '".$roomName."' ;";
        $result = $this->con->query($query);
        //var_dump($result);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                return $row['AdminID'];
            }
        }
        return -1 ;
    }
    function makeFriend($friendName , $userName){
        $query1= "insert into friends(friends_id,user_id)
        values(".$this->getUserIdByName($friendName).",".$this->getUserIdByName($userName).");";
        $query2= "insert into friends(friends_id,user_id)
        values(".$this->getUserIdByName($userName).",".$this->getUserIdByName($friendName).");";
        $this->con->query($query1);
        $this->con->query($query2);
    }
    function addUserToRoom($userName , $roomName){
        $query="insert into Accounts_rooms (account_id , room_id) values (".$this->getUserIdByName($userName)." , ".$this->getRoomID($roomName).");";
        $this->con->query($query);
    }
    function isUserAlreadyInRoom($userName  , $roomName):bool{
        $query = "select account_id from accounts_rooms where account_id = ".$this->getUserIdByName($userName)." and room_id = ".$this->getRoomID($roomName)." ;
        ";
        $result = $this->con->query($query);
        if($result->num_rows >0){
            return true; 
        }
        return false ;
    }
    function getFriendList($userName){
        $query = "select friends_id from friends where user_id = ".$this->getUserIdByName($userName) .";";
        $result = $this->con->query($query);
        $friendList=  [];
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $friendList[$this->getUserNameByID($row['friends_id'])] = $this->getUserProfileImage($this->getUserNameByID($row['friends_id']));
            }
        } 
        return $friendList;
    }
    function getSubscribersList($roomName  , $currentUser){
        $query = "select account_id from Accounts_rooms where room_id = ".$this->getRoomID($roomName);
        $result  = $this->con->query($query);
        $subscribers = [];
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                //echo 'current user : ' . $currentUser . '  the admin is :' .$this->getUserNameByID($this->getAdminIDOfRoom($roomName) )."  other is : ".$this->getUserNameByID($row['account_id']) . '<br>'; 
                if($currentUser == $this->getUserNameByID($row['account_id'])){
                    continue;
                }
                if($row['account_id'] == $this->getAdminIDOfRoom($roomName) && $this->getUserIdByName($currentUser) != $row['account_id'] ){//if the id is admin and the current user is not the admin
                    //$subscribers[$this->getUserNameByID($row['account_id'])] = [$this->getUserProfileImage($this->getUserNameByID($row['account_id'])) , 0 ];//zero means he is the admin
                    $subscribers[$this->getUserNameByID($row['account_id'])] = $this->getUserProfileImage($this->getUserNameByID($row['account_id'])) ;
                }
                else{
                    $subscribers[$this->getUserNameByID($row['account_id'])] = $this->getUserProfileImage($this->getUserNameByID($row['account_id']));
                }
            }
        }
        return $subscribers;
    }
    function getRoomNameByID($roomID){
        $query="select roomName from rooms where id = ".$roomID;
        $result = $this->con->query($query);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                return $row['roomName'];
            }
        }
    }
    function getSubscribedRooms($userName){
        $query="select room_id from accounts_rooms where account_id = ".$this->getUserIdByName($userName);
        $result = $this->con->query($query);
        $list= [] ; 
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
               // echo 'user id = '.$this->getUserIdByName($userName) . "  " . "room id = " .$this->getAdminIDOfRoom($this->getRoomNameByID($row['room_id'])) ; 
                if($this->getUserIdByName($userName) == $this->getAdminIDOfRoom($this->getRoomNameByID($row['room_id']))){
                    continue;
                }
                else{
                    array_push($list , $this->getRoomNameByID($row['room_id']));
                }
            }
        }
        return $list;
    }
    function removeUserFromRoom($userName , $roomName){
        $query = "delete from accounts_rooms where account_id = ". $this->getUserIdByName($userName) ." and room_id = ".$this->getRoomID($roomName)  ;
        $this->con->query($query);
        
    }
    function AdminRemoveRoom($userName, $roomName){
        $query1 = "delete from rooms where AdminID = ". $this->getUserIdByName($userName) . " and roomName = '".$roomName."'";
        $this->con->query($query1);
        $query2 = "delete from accounts_rooms where room_id = ". $this->getRoomID($roomName);
        $this->con->query($query2);
        //delete old requests 
    }
    function setConnectionID($userName , $id){
        $query = " 

        update accounts 
        set connectionID = '".$id."'
        where id = ".$this->getUserIdByName($userName)." ;

        " ; 
        if( $this->con->query($query)){
            //echo 'record is set ';
        }

    }
    function getConnectionID($userName){
        $query = "
        
                select connectionID from accounts where id = ".$this->getUserIdByName($userName)."

        " ;
        $result = $this->con->query($query);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                return $row['connectionID'];
            }
        }
    }
    function getConnectionIdSet($roomName){
        $query ="select connectionID from accounts 
        join accounts_rooms 
        on accounts.id = account_id where room_id =".$this->getRoomID($roomName)." ; " ;
        $result = $this->con->query($query); 
        $idList = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                array_push($idList, $row['connectionID']);
            }
        }
        return $idList ; 
    }
}
$sql = new databaseHandler;
/*echo $sql->getRoomCapacity('test' ,'veto') . "<br>";
echo $sql->numOFRoomParticipants('test') . "<br>";
echo $sql->getNumberOfFreePlaces('test', 'veto') . "<br";
*/
//print_r($sql->getMsgSet('cheese'));
//print_r($sql->getFriendList('jhon'));
//session_start();

//print_r($sql->getNameSet('jhon'));
//print_r($sql->getRoomName("udimy"));
//$nameList = $sql->getRoomName("zeko");
//echo $nameList[0];
//var_dump($sql->isRoomAlreadyExists("dd" ,"zeko"));
//print_r($sql->getNameSet('lego'));
//$nameList = $sql->getNameSet('lego');
//echo "hae";
//print_r($sql->getRoomName("zeko")) ;
//$sql->setUserStatus("zeko" , 1);
//echo $sql->getUserStatus("zeko");
//var_dump($sql->isAlreadyfriend('zeko' , 'giga chad'));
//var_dump($sql->isFriendRequestAlreadySent('zeko' , 'giga chad'));
//print_r($sql->getRoomsNameList('zeko'));
//echo $sql->getNumberOfFreePlaces('chess club' ,'Ali');
//print_r($sql->getFriendRequestSet('giga chad'));
//print_r($sql->getRoomRequestSet("giga chad"));
//echo $sql->numOFRoomParticipants('world1');
//$sql->deleteOldFriendRequest('zeko' , 'giga chad');
//$sql->deleteOldRoomRequest('giga' , 'zeko');
//echo $sql->getUserIdByName('zeko');
//print_r($sql->getFriendList('zeko'));
//$sql->removeFriend('giga chad', 'zeko');
//print_r($sql->getSubscribersList('guys' , 'giga chad'));
//print_r($sql->getSubscribedRooms('giga chad'));
/*echo $sql->numOFRoomParticipants('guys');
echo $sql->getRoomCapacity('guys' , 'guy');
echo $sql->getNumberOfFreePlaces('guys' , 'guy');
*/
//echo md5(uniqid());
//echo uniqid();
//print_r($sql->getConnectionIdSet('cheese'));
//$sql->setConnectionID('jhon' , md5(uniqid())) ;
//print_r($sql->getMsgSet('cheese'));
//$sql->msgCapture('hay' , 'jhon' , 'cheese');


?>





