<?php

namespace App;

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
    function onOpen(ConnectionInterface $conn)
    {
        $this->client->attach($conn);
        echo "New connexion";
        $conn->send($this->databaseService->ReadQuery("SELECT * FROM grid"));
    }

    /**
     * @inheritDoc
     * Event activated when a connexion is closed
     */
    function onClose(ConnectionInterface $conn)
    {
        $this->client->detach($conn);
    }

    /**
     * @inheritDoc
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occured : {$e->getMessage()}\n";
    }

    /**
     * @inheritDoc
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        // TODO: Implement onMessage() method.
        /* TODO :
           1 - Faire transiter les données des couleurs entre chaque client
           2 - Faire un enregistrement en base de donnée
        */

        $this->databaseService->PersistData($msg);

        $from->send($msg);

    }
}