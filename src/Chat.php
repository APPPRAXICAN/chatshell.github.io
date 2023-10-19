<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use function PHPSTORM_META\type;
class Chat implements MessageComponentInterface {
    protected $clients;
    private $networkMap ;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        //$this->clients = []; 
        $_POST['test'] = 'hi';
        
        
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
       $this->clients->attach($conn);
        //array_push($this->clients, $conn);
       echo "New connection! ({$conn->resourceId})\n";
        //$query = $conn->httpRequest->getUri()->getQuery();
        //echo $query; 
        //parse_str($query , $arr);
        
       //print_r($_SESSION);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        //$DB  = new databaseHandler();
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
          //      foreach($DB->getConnectionIdSet($_SESSION['roomName']) as $id){
                    
            //    }
            
            }
            
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
?>
