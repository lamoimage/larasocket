<?php

namespace Lamoimage\Larasocket;

class Larasocket implements Socket
{
    public $from;
    public $data;
    public $server;

    public function onOpen($server, $req)
    {
        $this->server = $server;
        $this->data = 'welcome, guest-'.$req->fd;
        $this->server->push($req->fd, json_encode(['type'=>'login', 'status'=>'success', 'from'=>'guest-' . $req->fd]));
        $this->push('welcome');
    }

    public function onMessage($server, $frame)
    {
        $data = json_decode($frame->data);
        switch ($data->action) {
            case 'sendmsg':
                $this->data = $data->msg;
                $this->from = $data->from;
                break;
            default:
                $this->data = 'aha, what do u want?';
                break;
        }
        $this->push();
    }

    public function onClose($server, $fd)
    {
        $this->data = 'bye..., guest-'.$fd;
        $this->push('welcome');
    }

    public function onRequest($request, $response)
    {
        echo 'onRequest';
    }

    protected function push($type = 'msg', $status = 'success')
    {
        $data = array(
                'status' => $status,
                'type' => $type,
                'from' => $this->from,
                'data' => $this->data
            );
        foreach ($this->server->connections as $fd) {
            $this->server->push($fd, json_encode($data));
        }
    }
}
