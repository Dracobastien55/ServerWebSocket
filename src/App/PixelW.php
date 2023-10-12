<?php

namespace App;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class PixelW implements MessageComponentInterface
{
    protected $client;

    public function __construct(){
        $this->client = new \SplObjectStorage();
    }

    /**
     * @inheritDoc
     * Event activated when a new connexion is made
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->client->attach($conn);
        echo "New connexion";
        // TODO : Read in database for place the pixel was already created
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
        // TODO: Implement onError() method.
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
    }
}