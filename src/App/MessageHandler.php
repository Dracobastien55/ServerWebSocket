<?php

namespace App;

use App\Service\DatabaseService;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class MessageHandler implements MessageComponentInterface
{
    protected $clients;
    
    protected $currentClient;

    protected $databaseService;

    public function __construct(){
        $this->clients = new \SplObjectStorage();
        $this->databaseService = new DatabaseService();
    }

    function onOpen(ConnectionInterface $conn): void
    {
        $this->currentClient = $conn;
        $this->clients->attach($conn);
        $conn->send($this->databaseService->getPixelRepository()->getAll());
    }

    function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    /**
     * @inheritDoc
     */
    function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error has occured : {$e->getMessage()}\n";
    }

    function onMessage(ConnectionInterface $from, $msg): void
    {
        $typeMsg = json_decode($msg, true);
        //For enter the data part of the json
        $datapart = $typeMsg['data'];

        $this->databaseService->getPixelRepository()->save($datapart);
        $id = $this->databaseService->getPixelRepository()->getByCoordinate($datapart['x_coordinate'], $datapart['y_coordinate']);
        $pixel = $this->databaseService->getPixelRepository()->getByID($id);
        $jsonData = array(
            "type" => "GetCurrentData",
            "data" => $pixel
        );

        /** @var ConnectionInterface $client */
        foreach ($this->clients as $client) {
            $client->send(json_encode($jsonData));
        }
    }
}