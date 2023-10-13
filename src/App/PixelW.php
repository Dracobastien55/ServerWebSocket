<?php

namespace App;

use App\Repository\UserRepository;
use App\Service\DatabaseService;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class PixelW implements MessageComponentInterface
{
    protected $client;

    protected $databaseService;

    public function __construct(){
        $this->client = new \SplObjectStorage();
        $this->databaseService = new DatabaseService();
    }

    /**
     * @inheritDoc
     * Event activated when a new connexion is made
     */
    function onOpen(ConnectionInterface $conn): void
    {
        $this->client->attach($conn);
        $idClient = count($this->client) + 1;
        $conn->send($idClient);
        $conn->send($this->databaseService->getPixelRepository()->getAll());
    }

    /**
     * @inheritDoc
     * Event activated when a connexion is closed
     */
    function onClose(ConnectionInterface $conn): void
    {
        $this->client->detach($conn);
    }

    /**
     * @inheritDoc
     */
    function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error has occured : {$e->getMessage()}\n";
    }

    /**
     * @inheritDoc
     */
    function onMessage(ConnectionInterface $from, $msg): void
    {
        echo "Voici le message reçue : ". $msg." \n";
        $typeMsg = json_decode($msg);
        echo "Voici le type message reçue : ".$typeMsg." \n";
        switch ($typeMsg['type']){
            case "CONNECTION":
                $this->databaseService->getUserRepository()->Save($msg);
                $jsonData = $this->databaseService->getPixelRepository()->getAll();
                $from->send($jsonData);
                break;
            case "PIXEL":
                $this->databaseService->getPixelRepository()->Save($msg);
                $id = $this->databaseService->getPixelRepository()->getByCoordinate($typeMsg['x_coordinate'], $typeMsg['y_coordinate']);
                $pixel = $this->databaseService->getPixelRepository()->getByID($id);
                break;
        }

        $from->send($msg);
    }
}