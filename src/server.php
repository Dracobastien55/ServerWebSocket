<?php

require 'vendor/autoload.php';
require 'App/MessageHandler.php';

use App\MessageHandler;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(new HttpServer(new WsServer(new MessageHandler())), 8080);
$server->run();

