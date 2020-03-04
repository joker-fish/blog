<?php

namespace app\game\controller;

use think\Controller;
use think\Db;

class Clear extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function oneGame()
    {
        Db::name('game_action_to_user')->where('user_id != 00000000000000')->delete();
        return '清除成功';
    }
    public function allAction()
    {
        Db::name('game_action_use')->where('id != 00000000')->delete();
        return '清除成功';
    }
    public function player()
    {
        Db::name('game_user')->where('id != 00000000')->delete();
        return '清除成功';
    }
}