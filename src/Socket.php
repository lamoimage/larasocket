<?php
namespace Lamoimage\Larasocket;

interface Socket
{
    public function onOpen($server, $request);
    public function onMessage($server, $frame);
    public function onClose($server, $fd);
    public function onRequest($request, $response);
}
