<?php

require 'vendor/autoload.php';
require 'App/PixelW.php';

use App\PixelW;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(new HttpServer(new WsServer(new PixelW())), 8080);
$server->run();

