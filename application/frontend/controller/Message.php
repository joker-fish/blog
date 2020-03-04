<?php

namespace app\frontend\controller;

use think\Db;

class Message extends Frontend
{
    public function index()
    {
        $this->assign('data', $this->Message->order('create_time desc')->select());
        return $this->fetch();
    }
    public function add()
    {
        $parmas = input();
        $data = [
            'avatar' => '/avatar/'.rand(1, 126).'.jpg',
            'name' => $parmas['name'],
            'email' => $parmas['email'],
            'content' => htmlspecialchars($parmas['lytext']),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'create_time' => time()
        ];
        $ip = Db::name('disip')->column('ip');
        if (in_array($data['ip'], $ip)){
            $this->success('你ip都被封了，煞笔');
        }
        $message = $this->Message->get(['ip'=>$data['ip']]);
        if (isset($message->id)){
            $data = [
                'avatar' => $message['avatar'],
                'name' => $message['name'],
                'email' => $message['email'],
                'content' => htmlspecialchars($parmas['lytext']),
                'ip' => $message['ip'],
                'create_time' => time()
            ];
        }
        $this->Message->save($data);
        $this->redirect('/message.html');
    }
}