<?php

namespace app\game\controller;

use app\common\model\GameAction;
use app\common\model\GameActionToUser;
use app\common\model\GameActionUse;
use app\common\model\GameUser;
use think\Controller;

class Action extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        $num = input('num');
        $evenModel = new GameActionToUser();
        $actionModel = new GameAction();
        $actionUseModel = new GameActionUse();

        $even = $evenModel->get(['user_id'=>$num]);
        if (isset($even->user_id)){
            $actionUse = $actionUseModel->get($even->action_id);
            $action = $actionModel->get($actionUse->id);
            echo '编号：'.$num.' &nbsp 暗号：'.$action->content;
            die();
        }
        $actionUseId = $actionUseModel->column('id');
        $key = array_rand($actionUseId, 1);
        $evenModel->save(['user_id'=>$num, 'action_id'=>$actionUseId[$key]]);
        $action = $actionModel->get(['id'=>$actionUseId[$key]]);

        echo '编号：'.$num.' &nbsp 暗号：'.$action->content;
    }
}